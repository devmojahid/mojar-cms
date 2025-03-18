$(document).ready(function () {
    let urlParams = new URLSearchParams(window.location.search);
    let template = urlParams.get('template');
    let bodyElement = $('body');

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    if (template) {
        $('select[name="meta[template]"]').val(template).trigger('change');
    }

    // Check if Select2 is available to avoid errors
    const isSelect2Available = typeof $.fn.select2 !== 'undefined';

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
            
            // Initialize Select2 for newly visible form if available
            if (isSelect2Available) {
                setTimeout(function() {
                    form.find('.select2').each(function() {
                        if (!$(this).hasClass('select2-hidden-accessible')) {
                            $(this).select2();
                        }
                    });
                }, 300);
            }
            
            // Initialize any media pickers
            initializeMediaPickers(form);
        } else {
            form.slideUp(250);
            blockItem.removeClass('editing');
        }
    });

    // Function to initialize media pickers
    function initializeMediaPickers(container) {
        container.find('.input-media').each(function() {
            let inputField = $(this);
            let previewContainer = inputField.siblings('.form-image-preview');
            
            // If there's a value, ensure the preview is shown
            if (inputField.val()) {
                if (previewContainer.length === 0) {
                    previewContainer = $('<div class="form-image-preview mt-2"></div>');
                    inputField.after(previewContainer);
                }
                
                let imgUrl = inputField.val();
                // Check if it's a full URL or just a path
                if (!imgUrl.startsWith('http') && !imgUrl.startsWith('/')) {
                    imgUrl = '/' + imgUrl;
                }
                
                previewContainer.html('<img src="' + imgUrl + '" alt="Preview">');
            }
            
            // Add event listener to update preview when value changes
            inputField.on('change input', function() {
                let val = $(this).val();
                if (val) {
                    if (previewContainer.length === 0) {
                        previewContainer = $('<div class="form-image-preview mt-2"></div>');
                        inputField.after(previewContainer);
                    }
                    
                    let imgUrl = val;
                    if (!imgUrl.startsWith('http') && !imgUrl.startsWith('/')) {
                        imgUrl = '/' + imgUrl;
                    }
                    
                    previewContainer.html('<img src="' + imgUrl + '" alt="Preview">');
                } else {
                    previewContainer.empty();
                }
            });
            
            // If this input field has a browse media button, make sure it's working
            let browseButton = inputField.siblings('.btn-browse-media');
            if (browseButton.length > 0 && typeof window.chooseMedia === 'function') {
                browseButton.off('click').on('click', function(e) {
                    e.preventDefault();
                    window.chooseMedia(inputField);
                });
            }
        });
    }

    // Add support for media browser integration if available
    if (typeof window.chooseMedia !== 'function' && typeof juzaweb !== 'undefined' && typeof juzaweb.media !== 'undefined') {
        window.chooseMedia = function(input) {
            juzaweb.media.open({
                multiple: false,
                type: 'image',
                selected: function(files) {
                    if (files.length > 0) {
                        let file = files[0];
                        $(input).val(file.path);
                        $(input).trigger('change');
                    }
                }
            });
        };
    }

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

    // Enhanced function to get all form values including selects, checkboxes, and file inputs
    function getAllFormValues(form) {
        let formValues = {};
        
        // Process regular inputs, selects, and textareas
        form.find(':input').each(function() {
            if ($(this).attr('name')) {
                if ($(this).is(':checkbox') || $(this).is(':radio')) {
                    if ($(this).is(':checked')) {
                        formValues[$(this).attr('name')] = $(this).val();
                    }
                } else {
                    formValues[$(this).attr('name')] = $(this).val();
                }
            }
        });
        
        // Handle special case for select2
        if (isSelect2Available) {
            form.find('.select2-hidden-accessible').each(function() {
                if ($(this).attr('name')) {
                    formValues[$(this).attr('name')] = $(this).val();
                }
            });
        }
        
        // Handle custom media pickers
        form.find('.input-media').each(function() {
            if ($(this).attr('name')) {
                formValues[$(this).attr('name')] = $(this).val();
            }
        });
        
        return formValues;
    }

    // Add new block - Modified to show configuration modal first
    bodyElement.on('click', '.add-block-data', function () {
        let block = $(this).data('block');
        let contentKey = $(this).data('content_key');
        let item = $(this);
        let template = document.getElementById('block-'+ block + '-template').innerHTML;
        let marker = (new Date()).getTime();
        
        // Replace template markers
        template = replace_template(template, {
            'marker': marker,
            'content_key': contentKey,
        });

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
        
        // // Hide the block selection modal
        // $('.page-block-content-modal').modal('hide');
        
        // // Create a temporary container to extract form content
        // let tempContainer = $('<div>').html(template);
        // let blockTitle = tempContainer.find('.block-label').text();
        // let formContent = tempContainer.find('.form-block-edit .block-form-wrapper').html();
        
        // // Configure block content modal
        // let configModal = $('#pageBlockContentModal');
        // configModal.find('.modal-title').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path></svg>Configure ' + blockTitle);
        
        // // Add form content to the modal body
        // configModal.find('.modal-body').html(formContent);
        
        // // Set up the action to take when confirmed
        // configModal.find('.modal-footer .btn-primary').off('click').on('click', function() {
        //     // Get form values from the modal using the enhanced function
        //     let formValues = getAllFormValues(configModal.find('.block-content-form'));
            
        //     // Create the block with configured values
        //     addBlockToPage(template, item, contentKey, marker, formValues);
            
        //     // Close the modal
        //     configModal.modal('hide');
        // });
        
        // // Initialize any form components in the modal
        // if (isSelect2Available) {
        //     setTimeout(function() {
        //         configModal.find('.select2').each(function() {
        //             try {
        //                 $(this).select2({
        //                     dropdownParent: configModal
        //                 });
        //             } catch (e) {
        //                 console.warn('Select2 initialization error:', e);
        //             }
        //         });
        //     }, 300);
        // }
        
        // // Initialize any media pickers in modal
        // initializeMediaPickers(configModal.find('.block-content-form'));
        
        // // Show the configuration modal
        // configModal.modal('show');
    });
    
    // Enhanced function to add the block to the page after configuration
    function addBlockToPage(template, item, contentKey, marker, formValues) {
        // Add the new block
        item.closest('.page-block-content').find('.dd-empty').remove();
        let ddList = item.closest('.page-block-content').find('.dd-list');
        let newItem = $(template);
        
        // Apply form values if provided
        if (formValues) {
            Object.keys(formValues).forEach(function(key) {
                let inputElement = newItem.find('[name="' + key + '"]');
                
                // Special handling for different input types
                if (inputElement.is(':checkbox') || inputElement.is(':radio')) {
                    inputElement.prop('checked', formValues[key] === inputElement.val());
                } else {
                    inputElement.val(formValues[key]);
                }
                
                // Handle image previews
                if (inputElement.hasClass('input-media') && formValues[key]) {
                    let previewContainer = inputElement.siblings('.form-image-preview');
                    if (previewContainer.length === 0) {
                        previewContainer = $('<div class="form-image-preview mt-2"></div>');
                        inputElement.after(previewContainer);
                    }
                    
                    let imgUrl = formValues[key];
                    // Check if it's a full URL or just a path
                    if (!imgUrl.startsWith('http') && !imgUrl.startsWith('/')) {
                        imgUrl = '/' + imgUrl;
                    }
                    
                    previewContainer.html('<img src="' + imgUrl + '" alt="Preview">');
                }
            });
        }
        
        ddList.append(newItem);
        
        // Initialize tooltips for new elements
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Initialize select2 for the new form - FIX: Use proper selector and initialization
        if (isSelect2Available) {
            setTimeout(function() {
                $('#page-block-' + marker).find('.select2').each(function() {
                    try {
                        $(this).select2();
                    } catch (e) {
                        console.warn('Select2 initialization error:', e);
                    }
                });
            }, 300);
        }
        
        // Update nestable
        $('.dd').nestable('reinit');
        
        // Show subtle success message
        showNotification('Block added successfully');
    }

    // Initialize nestable for drag and drop functionality
    $('.dd').nestable({
        maxDepth: 2,
        group: 1,
        dragClass: 'dd-dragel',
        handleClass: 'dd-handle',
        dragStart: function(e, el, dragEl) {
            // Add a class to the body during dragging for better styling control
            $('body').addClass('is-dragging');
            
            // Hide any open edit forms when dragging starts
            el.find('.form-block-edit:visible').hide();
            el.removeClass('editing');
            
            // Make drag element have proper styling
            dragEl.css({
                'width': el.width(),
                'background': '#ffffff'
            });
        },
        dragStop: function(e, el) {
            $('body').removeClass('is-dragging');
            
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

