<div class="page-block-content 1">
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
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            {{ trans('cms::app.add_block') }}
        </button>
    </div>

    <div class="modal modal-blur fade page-block-content-modal" id="blockSelectorModal-{{ $key }}"
        tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        All Blocks
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cards block-grid" id="blockGrid-{{ $key }}">
                        @foreach ($blocks as $bkey => $b)
                            <div class="col-sm-6 col-lg-4 block-item page-block-content-modal-item">
                                <div class="card block-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <img src="https://cdn.dribbble.com/users/844826/screenshots/14553706/media/2be9a4847b939e02702648d058cf2df8.png"
                                                    alt="{{ $b->get('label') }}" class="rounded">
                                            </div>
                                            <div class="col">
                                                <h3 class="card-title mb-1">
                                                    <a href="javascript:void(0)" class="dropdown-item add-block-data"
                                                        data-block="{{ $bkey }}" data-key="{{ $key }}"
                                                        data-content_key="{{ $contentKey }}">{{ $b->get('label') }}</a>
                                                </h3>
                                                <small class="text-muted">{{ $b->get('description', '') }}</small>
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-sm btn-primary add-block-data"
                                                        data-block="{{ $bkey }}"
                                                        data-key="{{ $key }}"
                                                        data-content_key="{{ $contentKey }}">{{ trans('cms::app.add_block') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ms-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="pageBlockContentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configure Block Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>

</div>
