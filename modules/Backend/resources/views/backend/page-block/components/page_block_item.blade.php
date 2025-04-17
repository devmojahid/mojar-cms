<li class="dd-item" id="dd-item-{{ $key }}" data-label="{{ $block->get('label') }}">
    <div class="dd-handle" aria-label="Drag to reorder" title="Drag to reorder">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-drag-drop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 11v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" /><path d="M13 13l9 3l-4 2l-2 4l-3 -9" /><path d="M3 3l0 .01" /><path d="M7 3l0 .01" /><path d="M11 3l0 .01" /><path d="M15 3l0 .01" /><path d="M3 7l0 .01" /><path d="M3 11l0 .01" /><path d="M3 15l0 .01" /></svg>
        </span>
    </div>
    <div class="block-header dd-nodrag">
        <div class="block-title">
            <span class="block-icon">
                <i class="ti ti-layout-grid"></i>
            </span>
            <span class="block-label">{{ $block->get('label') }}</span>
        </div>
        <div class="block-actions">
            <div class="block-action-button">
                <a href="javascript:void(0)" class="show-form-block" data-bs-toggle="tooltip" title="{{ trans('cms::app.edit') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                    </span>
                    <span class="d-none d-md-block">{{ trans('cms::app.edit') }}</span>
                </a>

                <a href="javascript:void(0)" class="remove-form-block" data-bs-toggle="tooltip" title="{{ trans('cms::app.delete') }}" aria-label="{{ trans('cms::app.delete') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </span>
                    <span class="d-none d-md-block">{{ trans('cms::app.delete') }}</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="form-block-edit dd-nodrag box-hidden" id="page-block-{{ $key }}">
        <div class="block-form-wrapper">
            @php
            $value = $value ?? [];
            @endphp
            @component(
                'cms::backend.page-block.block_form',
                compact('data', 'key', 'contentKey', 'value')
            )
            @endcomponent

            <input type="hidden" name="blocks[{{ $contentKey }}][{{ $key }}][block]" value="{{ $block->get('key') }}">
        </div>
    </div>
    
    <script>
        // Track initialization to prevent duplicates
        window.pageBlocksInitialized = window.pageBlocksInitialized || {};
        const blockId = 'dd-item-{{ $key }}';
        
        // Only initialize this block if not already done
        if (!window.pageBlocksInitialized[blockId]) {
            window.pageBlocksInitialized[blockId] = true;
            
            // Initialize Select2 and other components for this block
            $(document).ready(function() {
                const $blockItem = $('#dd-item-{{ $key }}');
                const $blockForm = $('#page-block-{{ $key }}');
                
                // Function to properly initialize all form elements in the block
                function initializeBlockFormElements() {
                    try {
                        // Use the global initialization function if available
                        if (typeof window.initializeSelect2Elements === 'function') {
                            window.initializeSelect2Elements($blockForm);
                        } else {
                            // Initialize Select2 dropdowns (fallback)
                            $blockForm.find('select').each(function() {
                                if (!$(this).hasClass('select2-hidden-accessible')) {
                                    $(this).select2({
                                        dropdownParent: $blockForm,
                                        width: '100%'
                                    });
                                }
                            });
                        }
                        
                        // Initialize any repeater fields in this block
                        $blockForm.find('.repeater-field').each(function() {
                            if (!$(this).hasClass('initialized')) {
                                $(this).addClass('initialized');
                                const event = new CustomEvent('repeater:init', { bubbles: true });
                                this.dispatchEvent(event);
                            }
                        });
                        
                        // Trigger a custom event for other components that might need initialization
                        $blockForm.trigger('block:elements:initialized');
                    } catch (error) {
                        console.error('Error initializing block elements in page_block_item:', error);
                        
                        // Try to recover by reinitializing after a delay
                        setTimeout(() => {
                            try {
                                // Simpler initialization as fallback
                                $blockForm.find('select').select2({
                                    width: '100%'
                                });
                            } catch (e) {
                                // Silent fail for recovery attempt
                            }
                        }, 500);
                    }
                }
                
                // Remove existing handler to prevent duplicates
                $blockItem.find('.show-form-block').off('click.showBlock');
                
                // When edit form becomes visible
                $blockItem.find('.show-form-block').on('click.showBlock', function(e) {
                    // Prevent default action and propagation
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Show the form
                    $blockForm.removeClass('box-hidden');
                    
                    // Use setTimeout to ensure the DOM is ready before initializing
                    setTimeout(initializeBlockFormElements, 200);
                });
                
                // Initialize elements if the form is already visible (editing existing block)
                if (!$blockForm.hasClass('box-hidden')) {
                    setTimeout(initializeBlockFormElements, 200);
                }
            });
        }
    </script>
</li>
