@extends('cms::layouts.backend')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="btn-group float-right">
                @if (config('mojar.theme.enable_upload'))
                    <a href="{{ route('admin.theme.install') }}" class="btn btn-success" data-turbolinks="false"><i
                            class="fa fa-plus-circle"></i> {{ trans('cms::app.add_new') }}</a>
                @endif
            </div>
        </div>
    </div>

    
    <div class="row row-cards">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-status-top bg-green"></div>
                <div class="card-header">
                  <h3 class="card-title">
                    Configuration
                  </h3>
                  <div class="card-actions">
                    <a href="#">
                      Edit configuration<!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <dl class="row">
                    <dt class="col-5">Date:</dt>
                    <dd class="col-7">2020-01-05 16:42:29 UTC</dd>
                    <dt class="col-5">Account:</dt>
                    <dd class="col-7">tabler</dd>
                    <dt class="col-5">Location:</dt>
                    <dd class="col-7"><span class="flag flag-country-pl"></span>
                      Poland</dd>
                    <dt class="col-5">IP Address:</dt>
                    <dd class="col-7">46.113.11.3</dd>
                    <dt class="col-5">Operating system:</dt>
                    <dd class="col-7">OS X 10.15.2 64-bit</dd>
                    <dt class="col-5">Browser:</dt>
                    <dd class="col-7">Chrome</dd>
                  </dl>
                </div>
                <div class="card-header">
                    <h3 class="card-title">
                      Configuration
                    </h3>
                    <div class="card-actions">
                      <a href="#">
                        Edit configuration<!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                      </a>
                    </div>
                  </div>
              </div>
        </div>
    </div>

    <div class="row" id="theme-list">
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
    </div>

    <template id="theme-template">
        <div class="col-md-4 p-2 theme-list-item">
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
