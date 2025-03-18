$(document).ready(function () {
    let urlParams = new URLSearchParams(window.location.search);
    let template = urlParams.get('template');
    let bodyElement = $('body');

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    if (template) {
        $('select[name="meta[template]"]').val(template).trigger('change');
    }

    // Show/hide block edit form
    bodyElement.on('click', '.show-form-block', function (e) {
        e.preventDefault();
        let form = $(this).closest('.dd-item').find('.form-block-edit');
        let blockItem = $(this).closest('.dd-item');
        
        if (form.is(':hidden')) {
            // Close any other open forms first for better UX
            $('.form-block-edit').not(form).hide(200);
            $('.dd-item').not(blockItem).removeClass('editing');
            
            form.slideDown(250);
            blockItem.addClass('editing');
        } else {
            form.slideUp(250);
            blockItem.removeClass('editing');
        }
    });

    // Remove block
    bodyElement.on('click', '.remove-form-block', function (e) {
        e.preventDefault();
        let blockItem = $(this).closest('.dd-item');
        
        if (confirm('Are you sure you want to remove this block?')) {
            blockItem.fadeOut(250, function() {
                blockItem.remove();
            });
        }
    });

    // Change template
    bodyElement.on('change', 'select[name="meta[template]"]', function () {
        let template = $(this).val();
        if (!template) {
            return false;
        }

        let currentUrl = window.location.href;
        currentUrl = currentUrl.split("?")[0];
        window.location = currentUrl + '?template=' + template;
    });

    // Search functionality for blocks
    bodyElement.on('keyup', '.block-search', function() {
        let searchTerm = $(this).val().toLowerCase();
        let blockItems = $(this).closest('.modal-content').find('.block-item');
        
        if (searchTerm.length === 0) {
            blockItems.show();
            return;
        }
        
        blockItems.each(function() {
            let blockTitle = $(this).find('.card-title').text().toLowerCase();
            let blockDesc = $(this).find('.text-muted').text().toLowerCase();
            
            if (blockTitle.includes(searchTerm) || blockDesc.includes(searchTerm)) {
                $(this).fadeIn(200);
            } else {
                $(this).fadeOut(200);
            }
        });
    });

    // Add new block
    bodyElement.on('click', '.add-block-data', function () {
        let block = $(this).data('block');
        let contentKey = $(this).data('content_key');
        let item = $(this);
        let template = document.getElementById('block-'+ block + '-template').innerHTML;
        let marker = (new Date()).getTime();
        template = replace_template(template, {
            'marker': marker,
            'content_key': contentKey,
        });

        // Hide modal
        $('.page-block-content-modal').modal('hide');

        // Add the new block
        item.closest('.page-block-content').find('.dd-empty').remove();
        let ddList = item.closest('.page-block-content').find('.dd-list');
        let newItem = $(template);
        ddList.append(newItem);
        
        // Initialize tooltips for new elements
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Initialize select2 for the new form
        initSelect2('#page-block-' + marker);
        
        // Update nestable
        $('.dd').nestable('reinit');
        
        // Show subtle success message
        showNotification('Block added successfully');
    });

    // Initialize nestable for drag and drop functionality
    $('.dd').nestable({
        maxDepth: 2,
        group: 1,
        callback: function(l, e) {
            // Show a subtle notification when blocks are reordered
            showNotification('Block order updated');
        }
    });
    
    // Helper function for showing notifications
    function showNotification(message) {
        let notification = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>');
            
        // Show notification
        if (!$('.notifications-container').length) {
            $('body').append('<div class="notifications-container position-fixed top-0 end-0 p-3" style="z-index: 5000;"></div>');
        }
        
        $('.notifications-container').append(notification);
        
        // Auto dismiss after 2.5 seconds
        setTimeout(function() {
            notification.alert('close');
        }, 2500);
    }
});

