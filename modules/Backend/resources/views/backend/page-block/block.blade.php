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
                        
                        // Use the global initialization function with better error handling
                        setTimeout(function() {
                            // Initialize select fields
                            if (typeof window.initializeSelect2Elements === 'function') {
                                window.initializeSelect2Elements($blockForm);
                            } else {
                                // Fallback if global function isn't available
                                $blockForm.find('select').each(function() {
                                    if (!$(this).hasClass('select2-hidden-accessible')) {
                                        $(this).select2({
                                            dropdownParent: $blockForm,
                                            width: '100%'
                                        });
                                    }
                                });
                            }
                            
                            // Initialize repeater fields
                            $blockForm.find('.repeater-field').each(function() {
                                if (!$(this).hasClass('initialized')) {
                                    $(this).addClass('initialized');
                                    const event = new CustomEvent('repeater:init', { bubbles: true });
                                    this.dispatchEvent(event);
                                }
                            });
                        }, 200);
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
        });
    }
</script>
