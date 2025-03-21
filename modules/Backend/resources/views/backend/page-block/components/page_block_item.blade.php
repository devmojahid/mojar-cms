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
        // Initialize Select2 for this block when it becomes visible
        $(document).ready(function() {
            // When edit form becomes visible, initialize select2
            $('.show-form-block').on('click', function() {
                let blockId = $(this).closest('.dd-item').find('.form-block-edit').attr('id');
                if (blockId) {
                    setTimeout(function() {
                        $('#' + blockId + ' .select2').each(function() {
                            if (!$(this).hasClass('select2-hidden-accessible')) {
                                $(this).select2();
                            }
                        });
                    }, 100);
                }
            });
        });
    </script>
</li>
