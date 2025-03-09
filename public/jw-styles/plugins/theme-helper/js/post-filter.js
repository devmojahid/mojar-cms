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
                    if (response.posts_html && response.posts_html.trim() !== '') {
                        this.postList.innerHTML = response.posts_html;
                    } else {
                        // No posts found
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
                    
                    if (this.pagination) {
                        this.pagination.innerHTML = response.pagination_html || '';
                    }
                    
                    // Update URL with filter parameters (for browser history)
                    this.updateBrowserHistory(filterState);
                    
                    // Scroll to top of post list
                    this.scrollToPostList();
                    
                    // Reinitialize any plugins that might be needed for the new content
                    this.reinitializePlugins();
                } else {
                    console.error('Error filtering posts:', response.message);
                    this.showErrorMessage(response.message || 'An error occurred while filtering posts.');
                }
            } catch (e) {
                console.error('Error parsing JSON response:', e);
                this.showErrorMessage('An error occurred while processing the server response.');
            }
        } else {
            console.error('Server returned error status:', this.currentRequest.status);
            this.showErrorMessage('Server error. Please try again later.');
        }
        
        // Hide loading overlay
        this.toggleLoading(false);
        this.currentRequest = null;
    };
    
    // Handle network errors
    this.currentRequest.onerror = () => {
        console.error('Connection error occurred while filtering posts');
        this.showErrorMessage('Network error. Please check your connection and try again.');
        this.toggleLoading(false);
        this.currentRequest = null;
    };
    
    // Send the request
    this.currentRequest.send(formData);
}

/**
 * Show error message to the user
 * @param {string} message - Error message to display
 */
showErrorMessage(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'tf__filter_error alert alert-danger';
    errorDiv.innerHTML = `
        <strong>Error:</strong> ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
    
    // Insert at the top of the post list
    if (this.postList.firstChild) {
        this.postList.insertBefore(errorDiv, this.postList.firstChild);
    } else {
        this.postList.appendChild(errorDiv);
    }
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        if (errorDiv.parentNode) {
            errorDiv.parentNode.removeChild(errorDiv);
        }
    }, 5000);
} 