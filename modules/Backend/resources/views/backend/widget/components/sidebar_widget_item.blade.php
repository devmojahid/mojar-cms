<li class="dd-item" data-widget="{{ $widget->get('key') }}" data-key="{{ $key }}" id="dd-item-{{ $key }}">
    <div class="dd-handle">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M9 4v16" />
                        <path d="M4 9h5" />
                        <path d="M4 14h5" />
                        <path d="M14 4v16" />
                        <path d="M15 9h4" />
                        <path d="M15 14h4" />
                    </svg>
                </span>
                <span class="widget-title">{{ $widget->get('label') }}</span>
            </div>
            <div class="dd-nodrag">
                <a href="javascript:void(0)" 
                   class="show-item-form btn btn-icon" 
                   >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="form-item-edit dd-nodrag">
        <div class="card mt-2 mb-2 border-0 shadow-none">
            <div class="card-body">
                @php
                    $data = $data ?? [];
                    $data['key'] = $key;
                @endphp

                <div class="widget-form-content">
                    {!! $widget['widget']->form($data) !!}
                </div>

                <input type="hidden" name="content[{{ $key }}][widget]" value="{{ $widget->get('key') }}">
                <input type="hidden" name="content[{{ $key }}][key]" value="{{ $key }}">

                <div class="d-flex justify-content-end align-items-center mt-3">
                    <a href="javascript:void(0)" class="delete-item-form btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                        {{ trans('cms::app.delete') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>

{{-- <li class="dd-item" data-widget="{{ $widget->get('key') }}" data-key="{{ $key }}" id="dd-item-{{ $key }}">
    <div class="dd-handle">
        <span>{{ $widget->get('label') }}</span>
        <div class="dd-nodrag">
            <a href="javascript:void(0)" class="show-item-form">
                <i class="fa fa-sort-down"></i>
            </a>
        </div>
    </div>

    <div class="form-item-edit dd-nodrag box-hidden">
        @php
            $data = $data ?? [];
            $data['key'] = $key;
        @endphp

        {!! $widget['widget']->form($data) !!}

        <input type="hidden" name="content[{{ $key }}][widget]" value="{{ $widget->get('key') }}">
        <input type="hidden" name="content[{{ $key }}][key]" value="{{ $key }}">

        <a href="javascript:void(0)" class="delete-item-form text-danger">
            <i class="fa fa-times"></i> {{ trans('cms::app.delete') }}
        </a>
    </div>
</li> --}}