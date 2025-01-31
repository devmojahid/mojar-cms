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


    <div class="modal modal-blur fade" id="pageBlockContentModal-{{ $key }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New report</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
              </div>
              <label class="form-label">Report type</label>
              <div class="form-selectgroup-boxes row mb-3">
                <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                      <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </span>
                      <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Simple</span>
                        <span class="d-block text-secondary">Provide only basic data needed for the report</span>
                      </span>
                    </span>
                  </label>
                </div>
                <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                      <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </span>
                      <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Advanced</span>
                        <span class="d-block text-secondary">Insert charts and additional advanced analyses to be inserted in the report</span>
                      </span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-8">
                  <div class="mb-3">
                    <label class="form-label">Report url</label>
                    <div class="input-group input-group-flat">
                      <span class="input-group-text">
                        https://tabler.io/reports/
                      </span>
                      <input type="text" class="form-control ps-0"  value="report-01" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="mb-3">
                    <label class="form-label">Visibility</label>
                    <select class="form-select">
                      <option value="1" selected>Private</option>
                      <option value="2">Public</option>
                      <option value="3">Hidden</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Client name</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Reporting period</label>
                    <input type="date" class="form-control">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Additional information</label>
                    <textarea class="form-control" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Cancel
              </a>
              <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Create new report
              </a>
            </div>
          </div>
        </div>
      </div>

</div>
