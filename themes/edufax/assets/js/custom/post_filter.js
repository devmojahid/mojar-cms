class PostFilter {
    constructor() {
        this.form = $('#post-filter-form');
        this.postList = $('#post-list');
        this.pagination = $('#pagination');
        this.timeout = null;
        this.currentRequest = null;
        this.initEvents();
    }

    initEvents() {
        const self = this;

        // Handle form submission
        this.form.on('submit', function(e) {
            e.preventDefault();
            self.filterPosts();
        });

        // Handle input changes with debounce
        this.form.find('.post-filter').on('change keyup', function() {
            clearTimeout(self.timeout);
            self.timeout = setTimeout(() => {
                self.filterPosts();
            }, 500);
        });

        // Handle pagination clicks
        $(document).on('click', '#pagination a', function(e) {
            e.preventDefault();
            self.filterPosts($(this).attr('href'));
        });
    }

    filterPosts(url = null) {
        const self = this;
        const formData = this.form.serialize();
        
        // Abort previous request if exists
        if (this.currentRequest) {
            this.currentRequest.abort();
        }

        // Show loading state
        this.postList.addClass('loading');
        
        // Make the AJAX request
        this.currentRequest = $.ajax({
            url: url || window.location.href,
            type: 'GET',
            data: formData,
            beforeSend: function() {
                // Add loading animation if needed
                self.postList.append('<div class="loading-overlay"><i class="fas fa-spinner fa-spin"></i></div>');
            },
            success: function(response) {
                // Update the posts list and pagination
                const $response = $(response);
                self.postList.html($response.find('#post-list').html());
                self.pagination.html($response.find('#pagination').html());
                
                // Update URL without page refresh
                if (url) {
                    window.history.pushState({}, '', url);
                }

                // Reinitialize any necessary plugins
                self.reinitPlugins();
            },
            error: function(xhr, status, error) {
                console.error('Error filtering posts:', error);
            },
            complete: function() {
                // Remove loading state
                self.postList.removeClass('loading');
                $('.loading-overlay').remove();
                self.currentRequest = null;
            }
        });
    }

    reinitPlugins() {
        // Reinitialize select2 if used
        if ($.fn.select2) {
            $('.select_js').select2();
        }

        // Reinitialize other plugins as needed
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
    }
}

// Initialize on document ready
$(document).ready(function() {
    new PostFilter();
});
