<div class="page-block-content">
    @php
        $currentTheme = jw_current_theme();
        $themePath = \Juzaweb\CMS\Facades\ThemeLoader::getThemePath($currentTheme);
    @endphp
    <div id="page-block-builder-nestable-{{ $key }}" class="dd jw-widget-builder">
        <ol class="dd-list">
            @foreach ($items as $index => $item)
                @php
                    $block = $blocks[$item['block']] ?? null;
                @endphp

                @if (empty($block))
                    @continue
                @endif

                @php
                    $data = $block->get('view')->getData();
                @endphp

                @if (empty($data))
                    @continue
                @endif

                @component('cms::backend.page-block.components.page_block_item', [
                    'data' => $data,
                    'key' => 'block-' . $index,
                    'block' => $block,
                    'contentKey' => $contentKey,
                    'value' => $item,
                ])
                @endcomponent
            @endforeach
        </ol>
    </div>

    <div class="text-center mt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#blockSelectorModal-{{ $key }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            {{ trans('cms::app.add_block') }}
        </button>
    </div>

    <!-- Block Selector Modal -->
    <div class="modal modal-blur fade page-block-content-modal" id="blockSelectorModal-{{ $key }}"
        tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-template me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M4 4m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z"></path>
                           <path d="M4 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                           <path d="M14 12l6 0"></path>
                           <path d="M14 16l6 0"></path>
                           <path d="M14 20l6 0"></path>
                        </svg>
                        {{ trans('cms::app.blocks') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="input-icon">
                            <input type="text" class="form-control block-search" placeholder="Search blocks...">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
                            </span>
                        </div>
                    </div>
                    
                    <div class="block-grid">
                        <div class="row row-cards g-3">
                            @foreach ($blocks as $bkey => $b)
                                <div class="col-md-6 col-lg-4 block-item">
                                    <div class="card block-card h-100">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar avatar-rounded bg-primary-lt me-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                       <path d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="card-title mb-0">{{ $b->get('label') }}</h3>
                                                </div>
                                            </div>
                                            <div class="text-muted mb-3">{{ $b->get('description', '') }}</div>
                                            <div class="mt-auto">
                                                <button type="button" class="btn btn-primary w-100 add-block-data"
                                                    data-block="{{ $bkey }}"
                                                    data-key="{{ $key }}"
                                                    data-content_key="{{ $contentKey }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                       <path d="M12 5l0 14"></path>
                                                       <path d="M5 12l14 0"></path>
                                                    </svg>
                                                    {{ trans('cms::app.add_block') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Configuration Modal for Block Content -->
    <div class="modal modal-blur fade" id="pageBlockContentModal" tabindex="-1" role="dialog" aria-labelledby="pageBlockConfigTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pageBlockConfigTitle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                           <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                        </svg>
                        Configure Block Content
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const contentKey = '{{ $contentKey }}';
        const key = '{{ $key }}';
        const blockContainer = $('#page-block-builder-nestable-{{ $key }}');
        
        // Helper function to generate a unique ID
        function generateUniqueId() {
            return 'block-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
        }
        
        // Function to carefully add a new block to the DOM
        function addBlockToDOM(container, html) {
            try {
                // Create a temporary div
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html.trim();
                
                // Get the first child element (the block)
                const newBlock = tempDiv.firstElementChild;
                
                if (!newBlock) {
                    console.error('Failed to create block element from template');
                    return null;
                }
                
                // Append to container
                container.append(newBlock);
                return newBlock;
            } catch (error) {
                console.error('Error adding block to DOM:', error);
                return null;
            }
        }
        
        // Function to safely initialize a new block's form elements
        function initializeNewBlock(blockElement) {
            try {
                if (!blockElement) return;
                
                // Get the form element
                const formElement = $(blockElement).find('.form-block-edit');
                
                if (formElement.length) {
                    // Make the form visible
                    formElement.removeClass('box-hidden');
                    
                    // Initialize with timeout to ensure DOM is ready
                    setTimeout(function() {
                        // Use the global initialization function
                        if (typeof window.initializeBlockContent === 'function') {
                            window.initializeBlockContent(formElement);
                        }
                        
                        // Trigger custom event
                        $(document).trigger('block:added', [formElement.attr('id').replace('page-block-', '')]);
                    }, 300);
                }
            } catch (error) {
                console.error('Error initializing new block:', error);
            }
        }
        
        // Remove any existing event handlers to prevent duplicates
        $('.add-block-data').off('click.addBlock');
        
        // Add block button handler
        $('.add-block-data').on('click.addBlock', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Prevent multiple executions
            if ($(this).data('processing')) {
                return;
            }
            
            $(this).data('processing', true);
            const $btn = $(this);
            
            try {
                const blockKey = $btn.data('block');
                const contentKey = $btn.data('content_key');
                const uniqueId = generateUniqueId();
                
                // Get the template 
                const templateElement = $('#block-' + blockKey + '-template');
                
                if (!templateElement.length) {
                    console.error('Template not found for block:', blockKey);
                    $btn.data('processing', false);
                    return;
                }
                
                // Clone the template content
                let templateHtml = templateElement.html();
                
                // Replace placeholder markers
                templateHtml = templateHtml.replace(/{marker}/g, uniqueId);
                templateHtml = templateHtml.replace(/{content_key}/g, contentKey);
                
                // Close the modal
                $('#blockSelectorModal-{{ $key }}').modal('hide');
                
                // Add the block to the DOM
                const ddList = blockContainer.find('.dd-list').first();
                const newBlock = addBlockToDOM(ddList, templateHtml);
                
                if (newBlock) {
                    // Initialize the new block
                    initializeNewBlock(newBlock);
                    
                    // Make sure nestable is refreshed if using it
                    if (typeof $.fn.nestable === 'function') {
                        blockContainer.nestable('refresh');
                    }
                }
                
                // Reset processing flag
                setTimeout(function() {
                    $btn.data('processing', false);
                }, 500);
                
            } catch (error) {
                console.error('Error adding block:', error);
                $btn.data('processing', false);
            }
        });
        
        // Add search functionality for block selector
        $('#blockSelectorModal-{{ $key }} .block-search').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            
            $('#blockSelectorModal-{{ $key }} .block-item').each(function() {
                const title = $(this).find('.card-title').text().toLowerCase();
                const description = $(this).find('.text-muted').text().toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Handle errors during block initialization
        window.addEventListener('error', function(event) {
            if (event.message && (
                event.message.includes('appendChild') || 
                event.message.includes('Unexpected token')
            )) {
                console.warn('Caught DOM error, attempting recovery:', event.message);
                event.preventDefault();
                
                // Try to recover by reinitializing select2 elements
                setTimeout(function() {
                    blockContainer.find('.select2-hidden-accessible').each(function() {
                        try {
                            $(this).select2('destroy');
                            $(this).select2({
                                width: '100%',
                                dropdownParent: $(this).closest('.form-block-edit')
                            });
                        } catch (e) {
                            // Silent fail for recovery attempt
                        }
                    });
                }, 300);
            }
        });
    });
</script>
