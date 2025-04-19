@php
    $blocks = \Juzaweb\CMS\Facades\HookAction::getPageBlocks();
    $templateBlocks = $templateData['blocks'] ?? [];
    $currentTheme = jw_current_theme();
    $themePath = \Juzaweb\CMS\Facades\ThemeLoader::getThemePath($currentTheme);
    $key = \Illuminate\Support\Str::random(15);
@endphp

@foreach ($templateBlocks as $contentKey => $block)
    @php
        $items = $model->getMeta('block_content', [])[$contentKey] ?? [];
    @endphp
    @component('cms::components.card', [
        'label' => $block['label'],
    ])
        @component(
            'cms::backend.page-block.components.content_form',
            compact('key', 'block', 'blocks', 'contentKey', 'items'))
        @endcomponent
    @endcomponent
@endforeach

@foreach ($blocks as $bkey => $block)
    @php
        $data = $block->get('view')->getData();
    @endphp

    @if (empty($data))
        @continue
    @endif

    <template id="block-{{ $bkey }}-template">
        @component('cms::backend.page-block.components.page_block_item', [
            'data' => $data,
            'key' => '{marker}',
            'block' => $block,
            'contentKey' => '{content_key}',
        ])
        @endcomponent
    </template>
@endforeach

<script>
    // Create a self-executing function to limit scope
    (function() {
        // Flag to track if initialization has already run for specific elements
        window.pageBlocksInitialized = window.pageBlocksInitialized || {};
        
        // Safely initialize select2 elements
        function initializeSelect2Elements(container) {
            try {
                if (!container || container.length === 0) return;
                
                // Convert to jQuery object if it's a DOM element
                const $container = $(container);
                
                // Find all select elements that need initialization
                $container.find('select').each(function() {
                    const $select = $(this);
                    
                    // Skip if already initialized
                    if ($select.hasClass('select2-hidden-accessible')) {
                        return;
                    }
                    
                    // Handle different select types
                    if ($select.hasClass('load-taxonomies')) {
                        $select.select2({
                            allowClear: true,
                            dropdownParent: $select.closest('.form-block-edit, .repeater-item'),
                            width: $select.data('width') || '100%',
                            placeholder: function(params) {
                                return {
                                    id: null,
                                    text: params.placeholder || 'Select an option',
                                };
                            },
                            ajax: {
                                method: 'GET',
                                url: mojar.adminUrl + '/load-data/loadTaxonomies',
                                dataType: 'json',
                                data: function(params) {
                                    const postType = $select.data('post-type');
                                    const taxonomy = $select.data('taxonomy');
                                    let explodes = $select.data('explodes');
                                    
                                    if (explodes) {
                                        explodes = $("." + explodes).map(function() {
                                            return $(this).val();
                                        }).get();
                                    }
                                    
                                    return {
                                        search: $.trim(params.term || ''),
                                        page: params.page || 1,
                                        explodes: explodes,
                                        post_type: postType,
                                        taxonomy: taxonomy
                                    };
                                }
                            }
                        });
                    } else {
                        // Regular select2
                        $select.select2({
                            dropdownParent: $select.closest('.form-block-edit, .repeater-item'),
                            width: '100%',
                            placeholder: $select.data('placeholder') || 'Select an option'
                        });
                    }
                });
            } catch (error) {
                console.error('Error initializing select2:', error);
            }
        }
        
        // Initialize repeater fields
        function initializeRepeaterFields(container) {
            try {
                if (!container || container.length === 0) return;
                
                const $container = $(container);
                
                $container.find('.repeater-field').each(function() {
                    // Skip if already initialized
                    if ($(this).hasClass('initialized')) {
                        return;
                    }
                    
                    $(this).addClass('initialized');
                    
                    // Safely trigger repeater initialization
                    try {
                        const event = new CustomEvent('repeater:init', { bubbles: true });
                        this.dispatchEvent(event);
                    } catch (error) {
                        console.error('Error initializing repeater field:', error);
                    }
                    
                    // Initialize select2 elements within this repeater
                    initializeSelect2Elements(this);
                });
            } catch (error) {
                console.error('Error initializing repeater fields:', error);
            }
        }
        
        // Define global function to initialize all field types in a container
        window.initializeBlockContent = function(container) {
            if (!container) return;
            
            // Use setTimeout to ensure DOM is ready
            setTimeout(function() {
                try {
                    const $container = $(container);
                    
                    // Initialize select2 first
                    initializeSelect2Elements($container);
                    
                    // Initialize repeater fields
                    initializeRepeaterFields($container);
                    
                    // Initialize any specialized taxonomy selects
                    $container.find('.load-taxonomies').each(function() {
                        if (!$(this).hasClass('select2-hidden-accessible')) {
                            try {
                                $(this).select2({
                                    allowClear: true,
                                    dropdownParent: $(this).closest('.form-block-edit, .repeater-item'),
                                    width: $(this).data('width') || '100%',
                                    placeholder: function(params) {
                                        return {
                                            id: null,
                                            text: params.placeholder || 'Select an option',
                                        };
                                    },
                                    ajax: {
                                        method: 'GET',
                                        url: mojar.adminUrl + '/load-data/loadTaxonomies',
                                        dataType: 'json',
                                        data: function(params) {
                                            const postType = $(this).data('post-type');
                                            const taxonomy = $(this).data('taxonomy');
                                            let explodes = $(this).data('explodes');
                                            
                                            if (explodes) {
                                                explodes = $("." + explodes).map(function() {
                                                    return $(this).val();
                                                }).get();
                                            }
                                            
                                            return {
                                                search: $.trim(params.term || ''),
                                                page: params.page || 1,
                                                explodes: explodes,
                                                post_type: postType,
                                                taxonomy: taxonomy
                                            };
                                        }
                                    }
                                });
                            } catch (error) {
                                console.error('Error initializing taxonomy select:', error);
                            }
                        }
                    });
                    
                    // Trigger a custom event that other components can listen for
                    $container.trigger('block:content:initialized');
                } catch (error) {
                    console.error('Error initializing block content:', error);
                }
            }, 300);
        };
        
        // Only run initialization once per page load
        if (!window.pageBlocksInitialized['global']) {
            window.pageBlocksInitialized['global'] = true;
            
            // Safe document ready handler
            $(function() {
                // Initialize all existing page blocks
                $('.page-block-content').each(function() {
                    const $pageBlockContent = $(this);
                    
                    // Initialize all blocks that are already visible (editing mode)
                    $pageBlockContent.find('.form-block-edit').each(function() {
                        if (!$(this).hasClass('box-hidden')) {
                            const $blockForm = $(this);
                            window.initializeBlockContent($blockForm);
                        }
                    });
                });
                
                // Error handling for appendChild issues
                window.addEventListener('error', function(event) {
                    if (event.message && event.message.includes('appendChild') && event.message.includes('Unexpected token')) {
                        console.warn('Caught DOM manipulation error. Attempting recovery...');
                        event.preventDefault(); // Prevent the error from bubbling up
                        
                        // Try to recover select2 components
                        setTimeout(function() {
                            try {
                                $('.select2-hidden-accessible').each(function() {
                                    try {
                                        $(this).select2('destroy');
                                    } catch (e) {}
                                    try {
                                        $(this).select2({
                                            width: '100%',
                                            dropdownParent: $(this).closest('.form-block-edit, .repeater-item')
                                        });
                                    } catch (e) {}
                                });
                            } catch (e) {
                                console.error('Recovery attempt failed:', e);
                            }
                        }, 100);
                    }
                });
                
                // Listen for the block:added event from page.js
                $(document).on('block:added', function(e, blockId) {
                    if (blockId) {
                        const blockForm = $('#page-block-' + blockId);
                        if (blockForm.length) {
                            window.initializeBlockContent(blockForm);
                        }
                    }
                });
                
                // Handle show/hide of block edit forms
                $(document).on('click', '.show-form-block', function() {
                    const $blockItem = $(this).closest('.dd-item');
                    const $blockForm = $blockItem.find('.form-block-edit');
                    
                    $blockForm.toggleClass('box-hidden');
                    
                    if (!$blockForm.hasClass('box-hidden')) {
                        window.initializeBlockContent($blockForm);
                    }
                });
            });
        }
    })();
</script>
