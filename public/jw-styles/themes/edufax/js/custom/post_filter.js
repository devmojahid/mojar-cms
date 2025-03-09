/**
 * Advanced Post Filter
 * Handles AJAX filtering for blog posts with loading animation
 */

console.log('AdvancedPostFilter 2');
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
        
        // Check for URL parameters on initial load
        this.loadFromUrl();
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
        
        // Handle dropdown changes (categories, sort) with immediate filtering
        const selectInputs = this.form.querySelectorAll('select.post-filter');
        selectInputs.forEach(input => {
            input.addEventListener('change', () => this.filterPosts());
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
            
            // Handle filter tag removal
            const tagRemove = e.target.closest('.tag-remove');
            if (tagRemove) {
                e.preventDefault();
                const filter = tagRemove.getAttribute('data-filter');
                this.removeFilter(filter);
            }
        });
    }
    
    /**
     * Remove a filter and refresh results
     * @param {string} filter - Filter to remove
     */
    removeFilter(filter) {
        if (filter === 'all') {
            // Reset all filters
            Array.from(this.form.elements).forEach(element => {
                if (element.name && element.name !== 'page') {
                    if (element.tagName === 'SELECT') {
                        if (element.name === 'sort') {
                            element.value = 'latest';
                        } else {
                            element.value = '';
                        }
                    } else {
                        element.value = '';
                    }
                }
            });
        } else {
            // Reset specific filter
            const element = this.form.elements[filter];
            if (element) {
                if (element.tagName === 'SELECT') {
                    if (element.name === 'sort') {
                        element.value = 'latest';
                    } else {
                        element.value = '';
                    }
                } else {
                    element.value = '';
                }
            }
        }
        
        // Trigger filter update
        this.filterPosts();
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
                        // Update posts HTML if there is content
                        if (response.posts_html && response.posts_html.trim() !== '') {
                            this.postList.innerHTML = response.posts_html;
                        } else {
                            // Empty state when no posts found
                            this.showEmptyState();
                        }
                        
                        // Update pagination if there is content
                        if (this.pagination) {
                            if (response.pagination_html && response.pagination_html.trim() !== '') {
                                this.pagination.innerHTML = response.pagination_html;
                            } else {
                                this.pagination.innerHTML = '';
                            }
                        }
                        
                        // Update URL with filter parameters (for browser history)
                        this.updateBrowserHistory(filterState);
                        
                        // Scroll to top of post list
                        this.scrollToPostList();
                        
                        // Reinitialize any plugins that might be needed for the new content
                        this.reinitializePlugins();
                    } else {
                        this.showErrorMessage(response.message || 'An error occurred while filtering posts.');
                    }
                } catch (e) {
                    this.showErrorMessage('An error occurred while processing the server response.');
                }
            } else {
                this.showErrorMessage('Server error. Please try again later.');
            }
            
            // Hide loading overlay
            this.toggleLoading(false);
            this.currentRequest = null;
        };
        
        // Handle network errors
        this.currentRequest.onerror = () => {
            this.showErrorMessage('Network error. Please check your connection and try again.');
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
    
    /**
     * Show empty state when no posts are found
     */
    showEmptyState() {
        this.postList.innerHTML = `
            <div class="col-12">
                <div class="tf__blog_empty_state">
                    <h3>No Posts Found</h3>
                    <p>We couldn't find any posts matching your criteria. Try changing your search terms or filters.</p>
                    <a href="${jwdata.base_url}" class="reset-button">Reset Filters</a>
                </div>
            </div>
        `;
    }
    
    /**
     * Load filters from URL parameters on initial page load
     */
    loadFromUrl() {
        const urlSearchParams = new URLSearchParams(window.location.search);
        const params = Object.fromEntries(urlSearchParams.entries());
        
        // Check if we have any filter parameters
        if (params.keyword || params.category || params.sort || params.page) {
            // Set form values based on URL parameters
            for (const [key, value] of Object.entries(params)) {
                const element = this.form.elements[key];
                if (element) {
                    element.value = value;
                }
            }
            
            // If we're on a specific page but not the first page, filter with the page parameter
            if (params.page && params.page !== '1') {
                this.filterPosts(parseInt(params.page, 10));
            } else if (params.keyword || params.category || (params.sort && params.sort !== 'latest')) {
                // Otherwise just filter with the current parameters
                this.filterPosts();
            }
        }
    }
}

// Initialize on DOM content loaded
document.addEventListener('DOMContentLoaded', () => {
    new AdvancedPostFilter();
});