@extends('cms::layouts.backend')

@section('content')
    <div class="card mb-2">
        <div class="card-header bg-transparent justify-content-between align-items-center">
            <h5 class="card-title">{{ __('Update CMS') }}</h5>
            <div>
                {{-- view change logs --}}
                <a href="https://github.com/mojar/cms/releases" target="_blank" class="btn btn-tabler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    {{ __('View change logs') }}
                </a>
                {{-- view update guide --}}
                <a href="https://mojar.com/documentation/start/update" target="_blank" class="btn btn-tabler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    {{ __('View update guide') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-success alert-dismissible">
                <p>{{ __('You are using Mojar CMS Version') }}: {{ \Juzaweb\CMS\Version::getVersion() }}</p>
            </div>

            <div id="update-form">
                <img src="{{ asset('themes/default/assets/images/loader.gif') }}" alt="">
            </div>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header bg-transparent justify-content-between align-items-center">
            <h5 class="card-title">{{ __('Update plugins') }}</h5>
            <div>
                <a href="https://github.com/mojar/cms/releases" target="_blank" class="btn btn-tabler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    {{ __('View change logs') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <form method="post" class="form-inline">
                        @csrf

                        <select name="bulk_actions" class="form-control select2-default" data-width="120px">
                            <option value="">{{ trans('cms::app.bulk_actions') }}</option>
                            <option value="update">{{ trans('cms::app.update') }}</option>
                        </select>

                        <button type="submit" class="btn btn-primary px-3"
                            id="apply-action-plugins">{{ trans('cms::app.apply') }}</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive mb-5">
                <table class="table table-vcenter" id="plugins-table">
                    <thead>
                        <tr>
                            <th data-field="state" data-width="3%" data-checkbox="true"></th>
                            <th data-field="plugin">{{ trans('cms::app.plugin') }}</th>
                            <th data-field="current_version" data-width="10%">{{ trans('cms::app.current_version') }}</th>
                            <th data-field="new_version" data-width="10%">{{ trans('cms::app.new_version') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header bg-transparent justify-content-between align-items-center">
            <h5 class="card-title">{{ __('Update themes') }}</h5>
            <div>
                <a href="https://github.com/mojar/cms/releases" target="_blank" class="btn btn-tabler">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    {{ __('View change logs') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <form method="post" class="form-inline">
                        @csrf

                        <select name="bulk_actions" class="form-control select2-default" data-width="120px">
                            <option value="">{{ trans('cms::app.bulk_actions') }}</option>
                            <option value="update">{{ trans('cms::app.update') }}</option>
                        </select>

                        <button type="submit" class="btn btn-primary px-3"
                            id="apply-action-themes">{{ trans('cms::app.apply') }}</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive mb-5">
                <table class="table" id="themes-table">
                    <thead>
                        <tr>
                            <th data-field="state" data-width="3%" data-checkbox="true"></th>
                            <th data-field="theme">{{ trans('cms::app.theme') }}</th>
                            <th data-field="current_version" data-width="10%">{{ trans('cms::app.current_version') }}</th>
                            <th data-field="new_version" data-width="10%">{{ trans('cms::app.new_version') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function update_success() {
            setTimeout(function() {
                window.location = "";
            }, 300);
            return false;
        }

        var table1 = new MojarTable({
            table: "#plugins-table",
            apply_button: "#apply-action-plugins",
            url: "{{ route('admin.update.plugins') }}",
            action_url: "{{ route('admin.plugin.bulk-actions') }}"
        });

        var table2 = new MojarTable({
            table: "#themes-table",
            apply_button: "#apply-action-themes",
            url: "{{ route('admin.update.themes') }}",
            action_url: "{{ route('admin.themes.bulk-actions') }}"
        });

        ajaxRequest("{{ route('admin.update.check') }}", {}, {
            method: 'GET',
            callback: function(response) {
                $('#update-form').html(response.html);
            }
        })
    </script>
@endsection
