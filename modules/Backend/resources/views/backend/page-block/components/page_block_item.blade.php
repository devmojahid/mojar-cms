<li class="dd-item" id="dd-item-{{ $key }}" data-label="{{ $block->get('label') }}">
    <div class="dd-handle">
        <div class="block-header">
            <div class="block-title">
                <span class="block-icon">
                    <i class="ti ti-layout-grid"></i>
                </span>
                <span class="block-label">{{ $block->get('label') }}</span>
            </div>
            <div class="dd-nodrag block-actions">
                <div class="block-action-button">
                    <a href="javascript:void(0)" class="show-form-block">
                        <i class="ti ti-edit"></i>
                        <span>{{ trans('cms::app.edit') }}</span>
                    </a>

                    <a href="javascript:void(0)" class="remove-form-block">
                        <i class="ti ti-trash"></i>
                        <span>{{ trans('cms::app.delete') }}</span>
                    </a>
                </div>
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
</li>
