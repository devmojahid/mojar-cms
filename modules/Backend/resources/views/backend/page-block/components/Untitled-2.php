you can aslo enhance the structure also but not to much change main logic and drag and drop and functionality works perfectly but problem with the and design should modern and good looking and fully responsive and wel organized and full system. i want to redisen the system without remove current system ids and class like 

and aslo there and this section is so borring ui/ux and looks like borring and brocekn alignmenet and dd-handle and block-title design is conflict need more enhancemenet with fully responsive and modern and good looking and wel organized and full system.
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
    

# main page wrapper
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
</div>

this have component like  page_block_item.blade.php
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

this have component like block_form.blade.php
@foreach($data['form'] ?? [] as $input)
    @if($input['type'] == 'container')
        <h5>{{ __($input['label']) }}</h5>
        @foreach($input['children'] ?? [] as $child)
            @php
                $child['data']['value'] = $value[$input['name']][$child['name']] ?? null;
                $child['name'] = "blocks[{$contentKey}][{$key}][{$input['name']}][{$child['name']}]";
            @endphp

            {{ Field::fieldByType($child) }}
        @endforeach
    @else
        @php
            $input['data']['value'] = $value[$input['name']] ?? null;
            $input['name'] = "blocks[{$contentKey}][{$key}][{$input['name']}]";
        @endphp

        {{ Field::fieldByType($input) }}
    @endif

@endforeach

make sure the pattern page-block-content this inside the @component('cms::backend.page-block.components.page_block_item', [ 
this componenet and inside this componenet we have other componenet like 


and wrtie scss in resources\sass\dashboard\sections\_page_block.scss write all scss under the wrapper for any other places do not conflict

current scss file like 
    .dd {
        .dd-list {
            .dd-item {
                background: var(--tblr-bg-surface);
                border-radius: 0.5rem;
                border: 1px solid var(--tblr-border-color);
                margin-bottom: 1rem;
                transition: all 0.2s ease;

                &:hover {
                    border-color: var(--tblr-primary);
                    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                }

                .dd-handle {
                    border: none;
                    background: transparent;
                    padding: 1rem;
                    margin: 0;
                    cursor: move;

                    .block-header {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 1rem;

                        .block-title {
                            display: flex;
                            align-items: center;
                            gap: 0.75rem;

                            .block-icon {
                                width: 2rem;
                                height: 2rem;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                background: var(--tblr-primary-lt);
                                color: var(--tblr-primary);
                                border-radius: 0.375rem;

                                i {
                                    font-size: 1.25rem;
                                }
                            }

                            .block-label {
                                font-weight: 500;
                                color: var(--tblr-body-color);
                            }
                        }

                        .block-actions {
                            .block-action-button {
                                display: flex;
                                gap: 1rem;

                                a {
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                    padding: 0.375rem 0.75rem;
                                    border-radius: 0.375rem;
                                    color: var(--tblr-body-color);
                                    transition: all 0.2s ease;

                                    &:hover {
                                        background: var(--tblr-bg-surface);
                                    }

                                    &.show-form-block:hover {
                                        color: var(--tblr-primary);
                                    }

                                    &.remove-form-block {
                                        &:hover {
                                            color: var(--tblr-danger);
                                            background: var(--tblr-danger-lt);
                                        }
                                    }

                                    i {
                                        font-size: 1.25rem;
                                    }
                                }
                            }
                        }
                    }
                }

                .form-block-edit {
                    padding: 1rem;
                    border-top: 1px solid var(--tblr-border-color);
                    background: var(--tblr-bg-surface);
                    border-radius: 0 0 0.5rem 0.5rem;

                    .block-form-wrapper {
                        .form-group {
                            margin-bottom: 1.5rem;

                            label {
                                font-weight: 500;
                                margin-bottom: 0.5rem;
                            }

                            .form-control {
                                &:focus {
                                    border-color: var(--tblr-primary);
                                    box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.1);
                                }
                            }
                        }
                    }
                }

                &.dd-collapsed {
                    .dd-handle {
                        border-radius: 0.5rem;
                    }
                }
            }
        }
    }

    // Responsive styles
    @media (max-width: 768px) {
        .dd-item {
            .dd-handle {
                .block-header {
                    flex-direction: column;
                    align-items: flex-start;

                    .block-actions {
                        width: 100%;
                        margin-top: 0.5rem;

                        .block-action-button {
                            justify-content: flex-start;
                        }
                    }
                }
            }
        }
    }
}

// Nestable styles
.dd {
    position: relative;
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none;

        .dd-item {
            display: block;
            position: relative;
            margin: 0.5rem 0;
            padding: 0;
            min-height: 2rem;

            &:hover {
                > .dd-handle {
                    border-color: var(--tblr-primary);
                }
            }
        }

        .dd-handle {
            display: block;
            position: relative;
            margin: 0;
            padding: 0.5rem;
            background: #fff;
            border: 1px solid var(--tblr-border-color);
            border-radius: 0.25rem;
            cursor: move;

            &:hover {
                background: var(--tblr-light);
            }
        }
    }
}

// Responsive adjustments
@media (max-width: 768px) {
    .block-grid {
        .col-sm-6 {
            width: 100%;
        }
    }

    .modal-dialog {
        margin: 0.5rem;
    }
}

.page-block-content-modal {
    z-index: 1200;
    .modal-dialog {
        max-width: 90vw;
        max-height: 90vh;
    }
}