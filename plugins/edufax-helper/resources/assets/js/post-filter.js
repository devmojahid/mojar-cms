/**
 * Advanced Post Filter
 * Handles AJAX filtering for blog posts with loading animation
 */
class AdvancedPostFilter {
    constructor() {
        // Elements
        this.form = document.getElementById('post-filter-form');
        this.postList = document.getElementById('post-list');
        this.pagination = document.getElementById('pagination');
        
        // Settings
        this.debounceTimeout = null;
        this.debounceDelay = 500;
        this.currentRequest = null;
        this.isLoading = false;
        this.currentUrl = window.location.href;
        
        // Initialize
        this.init();
    }
    
    /**
     * Initialize the filter
     */
    init() {
        if (!this.form || !this.postList) return;
        
        // Set up event listeners
        this.setupEventListeners();
        
        // Create loading overlay
        this.createLoadingOverlay();
        
        // Handle browser back/forward buttons
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.filter) {
                this.loadFromState(e.state.filter);
            }
        });
    }
    
    /**
     * Create the loading overlay element
     */
    createLoadingOverlay() {
        this.loadingOverlay = document.createElement('div');
        this.loadingOverlay.className = 'tf__post_filter_loading';
        this.loadingOverlay.innerHTML = `
            <div class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="loading-text">Loading...</div>
            </div>
        `;
        
        document.body.appendChild(this.loadingOverlay);
        
        // Add CSS for loading overlay
        const style = document.createElement('style');
        style.textContent = `
            .tf__post_filter_loading {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.7);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s, visibility 0.3s;
            }
            .tf__post_filter_loading.active {
                opacity: 1;
                visibility: visible;
            }
            .tf__post_filter_loading .loading-spinner {
                display: flex;
                flex-direction: column;
                align-items: center;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }
            .tf__post_filter_loading .loading-text {
                margin-top: 10px;
                font-weight: bold;
            }
        `;
        document.head.appendChild(style);
    }
    
    /**
     * Set up event listeners for form inputs
     */
    setupEventListeners() {
        // Form submission
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.filterPosts();
        });
        
        // Handle input changes with debounce
        const filterInputs = this.form.querySelectorAll('.post-filter');
        filterInputs.forEach(input => {
            input.addEventListener('change', () => this.debounceFilter());
            if (input.tagName === 'INPUT') {
                input.addEventListener('keyup', () => this.debounceFilter());
            }
        });
        
        // Handle pagination clicks
        document.addEventListener('click', (e) => {
            const paginationLink = e.target.closest('#pagination a');
            if (paginationLink) {
                e.preventDefault();
                const page = this.getPageFromUrl(paginationLink.getAttribute('href'));
                if (page) {
                    this.filterPosts(page);
                }
            }
        });
    }
    
    /**
     * Debounce filter to prevent excessive AJAX calls
     */
    debounceFilter() {
        clearTimeout(this.debounceTimeout);
        this.debounceTimeout = setTimeout(() => {
            this.filterPosts();
        }, this.debounceDelay);
    }
    
    /**
     * Extract page number from URL
     * @param {string} url - URL to extract page from
     * @returns {number|null} - Page number or null
     */
    getPageFromUrl(url) {
        const match = url.match(/page=(\d+)/);
        return match ? parseInt(match[1]) : null;
    }
    
    /**
     * Filter posts via AJAX
     * @param {number} page - Page number to load
     */
    filterPosts(page = 1) {
        // Show loading overlay
        this.toggleLoading(true);
        
        // Abort any ongoing requests
        if (this.currentRequest) {
            this.currentRequest.abort();
        }
        
        // Collect form data
        const formData = new FormData(this.form);
        formData.append('page', page);
        
        // Remember the filter state for browser history
        const filterState = {};
        for (const [key, value] of formData.entries()) {
            if (value) {
                filterState[key] = value;
            }
        }
        
        // Create AJAX request
        this.currentRequest = new XMLHttpRequest();
        this.currentRequest.open('POST', jwdata.base_url + '/ajax/posts/filter');
        this.currentRequest.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        this.currentRequest.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        // Handle response
        this.currentRequest.onload = () => {
            if (this.currentRequest.status >= 200 && this.currentRequest.status < 400) {
                try {
                    const response = JSON.parse(this.currentRequest.responseText);
                    
                    if (response.status === 'success') {
                        // Update posts and pagination
                        this.postList.innerHTML = response.posts_html;
                        if (this.pagination) {
                            this.pagination.innerHTML = response.pagination_html;
                        }
                        
                        // Update URL with filter parameters (for browser history)
                        this.updateBrowserHistory(filterState);
                        
                        // Scroll to top of post list
                        this.scrollToPostList();
                        
                        // Reinitialize any plugins that might be needed for the new content
                        this.reinitializePlugins();
                    } else {
                        console.error('Error filtering posts:', response.message);
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                }
            } else {
                console.error('Server returned error status:', this.currentRequest.status);
            }
            
            // Hide loading overlay
            this.toggleLoading(false);
            this.currentRequest = null;
        };
        
        // Handle network errors
        this.currentRequest.onerror = () => {
            console.error('Connection error occurred while filtering posts');
            this.toggleLoading(false);
            this.currentRequest = null;
        };
        
        // Send the request
        this.currentRequest.send(formData);
    }
    
    /**
     * Update browser history state
     * @param {Object} filterState - Current filter state
     */
    updateBrowserHistory(filterState) {
        const url = new URL(window.location.href);
        
        // Clear existing parameters
        for (const key of url.searchParams.keys()) {
            if (key !== 'post_type') { // Preserve post_type parameter
                url.searchParams.delete(key);
            }
        }
        
        // Add new parameters
        for (const [key, value] of Object.entries(filterState)) {
            if (value && key !== 'post_type') {
                url.searchParams.set(key, value);
            }
        }
        
        // Update browser history
        const newUrl = url.toString();
        window.history.pushState({filter: filterState}, '', newUrl);
    }
    
    /**
     * Load posts from browser history state
     * @param {Object} filterState - Filter state to load
     */
    loadFromState(filterState) {
        // Reset form inputs based on state
        const formElements = this.form.elements;
        
        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            
            if (element.name && filterState[element.name] !== undefined) {
                if (element.type === 'checkbox' || element.type === 'radio') {
                    element.checked = (element.value === filterState[element.name]);
                } else {
                    element.value = filterState[element.name];
                }
            } else if (element.name) {
                if (element.type === 'checkbox' || element.type === 'radio') {
                    element.checked = false;
                } else {
                    element.value = '';
                }
            }
        }
        
        // Filter with the state
        this.filterPosts(filterState.page || 1);
    }
    
    /**
     * Toggle loading overlay
     * @param {boolean} show - Whether to show or hide loading
     */
    toggleLoading(show) {
        this.isLoading = show;
        if (show) {
            this.loadingOverlay.classList.add('active');
        } else {
            this.loadingOverlay.classList.remove('active');
        }
    }
    
    /**
     * Scroll to post list after filtering
     */
    scrollToPostList() {
        if (this.postList) {
            window.scrollTo({
                top: this.postList.offsetTop - 100,
                behavior: 'smooth'
            });
        }
    }
    
    /**
     * Reinitialize any plugins or scripts needed after content update
     */
    reinitializePlugins() {
        // Reinitialize any select2 or other enhanced inputs
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select_js').select2();
        }
        
        // Re-initialize any image lazy loading or other plugins
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
        
        // You can add other reinitializations as needed
    }
}

// Initialize on DOM content loaded
document.addEventListener('DOMContentLoaded', () => {
    new AdvancedPostFilter();
}); 