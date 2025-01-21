@extends('cms::layouts.backend')

@section('breadcrumb-right')
    <div class="col-auto mb-3">
        <div class="btn-group float-right">
            @if (config('mojar.theme.enable_upload'))
                <a href="{{ route('admin.theme.install') }}" class="btn btn-tabler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    {{ trans('cms::app.add_new') }}</a>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-cards" id="theme-list">
        @if ($currentTheme)
        <div class="col-lg-4 theme-list-item" >
            <div class="card">
                <div class="card-status-top bg-green"></div>
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $currentTheme->get('title') }}
                    </h3>
                    <div class="card-actions">
                        <button class="btn btn-tabler" disabled>
                            {{ trans('cms::app.activated') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                        data-src="{{ $currentTheme->get('screenshot') }}" alt="{{ $currentTheme->get('title') }}"
                        class="lazyload w-100 h-100">
                </div>
                <div class="card-footer">
                    <div class="mb-3">
                        <div class="text-muted">
                            <div class="d-flex align-items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                                <span>{{ $currentTheme->get('author') }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                                    <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                                    <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                                    <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                                    <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" />
                                </svg>
                                <span>v{{ $currentTheme->get('version') }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                    <line x1="8" y1="9" x2="16" y2="9" />
                                    <line x1="8" y1="13" x2="14" y2="13" />
                                </svg>
                                <span>{{ $currentTheme->get('description') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- <div class="row" id="theme-list">
        @if ($currentTheme)
            <div class="col-md-4 p-2 theme-list-item">
                <div class="card">
                    <div class="height-200 d-flex flex-column jw__g13__head">
                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                            data-src="{{ $currentTheme->get('screenshot') }}" alt="{{ $currentTheme->get('title') }}"
                            class="lazyload w-100 h-100">
                    </div>

                    <div class="card card-bottom card-borderless mb-0">
                        <div class="card-header border-bottom-0">
                            <div class="d-flex">
                                <div class="text-dark text-uppercase font-weight-bold mr-auto">
                                    {{ $currentTheme->get('title') }}
                                </div>
                                <div class="text-gray-6">
                                    <button class="btn btn-secondary" disabled> {{ trans('cms::app.activated') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div> --}}

    <template id="theme-template">
        <div class="col-md-4 theme-list-item">
            {content}
        </div>
    </template>

    <script>
        toggle_global_loading(true);

        setTimeout(function() {
            const listView = new MojarListView({
                url: "{{ route('admin.themes.get-data') }}",
                list: "#theme-list",
                template: "theme-template",
                page_size: 9,
                after_load_callback: function() {
                    toggle_global_loading(false);
                }
            });
        }, 300)
    </script>

    <script type="text/javascript">
        $('#theme-list').on('click', '.active-theme', function() {
            let btn = $(this);
            let icon = btn.find('i').attr('class');
            let theme = btn.data('theme');

            btn.find('i').attr('class', 'fa fa-spinner fa-spin');
            btn.prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.themes.activate') }}",
                dataType: 'json',
                data: {
                    theme: theme
                }
            }).done(function(response) {
                btn.find('i').attr('class', icon);
                btn.prop("disabled", false);

                if (response.status === false) {
                    show_message(response.data.message);
                    return false;
                }

                window.location = "";
                return false;
            }).fail(function(response) {
                btn.find('i').attr('class', icon);
                btn.prop("disabled", false);
                show_message(response);
                return false;
            });
        });
    </script>
@endsection
