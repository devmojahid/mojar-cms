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
    // Flag to track if initialization has already run
    window.pageBlocksInitialized = window.pageBlocksInitialized || {};
    
    // Define a global function to initialize all field types in a container
    window.initializeBlockContent = function(container) {
        if (!container) return;
        
        // Use setTimeout to ensure DOM is ready
        setTimeout(function() {
            try {
                const $container = $(container);
                
                // Call the global select2 initialization if available
                if (typeof initSelect2 === 'function') {
                    initSelect2(container);
                }
                
                // Initialize any specialized select2 elements
                if (typeof window.initializeSelect2Elements === 'function') {
                    window.initializeSelect2Elements($container);
                }
                
                // Initialize repeater fields
                $container.find('.repeater-field').each(function() {
                    if (!$(this).hasClass('initialized')) {
                        $(this).addClass('initialized');
                        const event = new CustomEvent('repeater:init', { bubbles: true });
                        this.dispatchEvent(event);
                    }
                });
                
                // Initialize any taxonomy selects
                $container.find('.load-taxonomies').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            allowClear: true,
                            dropdownAutoWidth: !$(this).data('width'),
                            width: $(this).data('width') || '100%',
                            placeholder: function (params) {
                                return {
                                    id: null,
                                    text: params.placeholder,
                                }
                            },
                            ajax: {
                                method: 'GET',
                                url: mojar.adminUrl + '/load-data/loadTaxonomies',
                                dataType: 'json',
                                data: function (params) {
                                    let postType = $(this).data('post-type');
                                    let taxonomy = $(this).data('taxonomy');
                                    let explodes = $(this).data('explodes');
                                    if (explodes) {
                                        explodes = $("." + explodes).map(function () {
                                            return $(this).val();
                                        }).get();
                                    }

                                    return {
                                        search: $.trim(params.term),
                                        page: params.page,
                                        explodes: explodes,
                                        post_type: postType,
                                        taxonomy: taxonomy
                                    };
                                }
                            }
                        });
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
        
        // Ensure all page blocks are properly initialized when the page loads
        $(document).ready(function() {
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
            
            // Handle page block errors gracefully
            window.addEventListener('error', function(event) {
                if (event.message && event.message.includes('appendChild') && event.message.includes('Unexpected token')) {
                    console.error('Page block error detected:', event.message);
                    event.preventDefault(); // Prevent the error from bubbling up
                    
                    // Try to recover by refreshing select2 components
                    $('.select2-hidden-accessible').each(function() {
                        try {
                            $(this).select2('destroy');
                            $(this).select2();
                        } catch (e) {
                            // Silently continue if recovery fails
                        }
                    });
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
        });
    }
</script>
