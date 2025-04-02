@extends('cms::layouts.backend')

@section('content')
    <div class="card mt-3 mb-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a href="#tabs-import-form-blogger" class="nav-link active" data-bs-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-blogger">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M8 21h8a5 5 0 0 0 5 -5v-3a3 3 0 0 0 -3 -3h-1v-2a5 5 0 0 0 -5 -5h-4a5 5 0 0 0 -5 5v8a5 5 0 0 0 5 5z" />
                            <path
                                d="M7 7m0 1.5a1.5 1.5 0 0 1 1.5 -1.5h3a1.5 1.5 0 0 1 1.5 1.5v0a1.5 1.5 0 0 1 -1.5 1.5h-3a1.5 1.5 0 0 1 -1.5 -1.5z" />
                            <path
                                d="M7 14m0 1.5a1.5 1.5 0 0 1 1.5 -1.5h7a1.5 1.5 0 0 1 1.5 1.5v0a1.5 1.5 0 0 1 -1.5 1.5h-7a1.5 1.5 0 0 1 -1.5 -1.5z" />
                        </svg>
                        {{ __('Import From Blogger') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tabs-import-form-wordpress" class="nav-link" data-bs-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-wordpress">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9.5 9h3" />
                            <path d="M4 9h2.5" />
                            <path d="M11 9l3 11l4 -9" />
                            <path d="M5.5 9l3.5 11l3 -7" />
                            <path
                                d="M18 11c.177 -.528 1 -1.364 1 -2.5c0 -1.78 -.776 -2.5 -1.875 -2.5c-.898 0 -1.125 .812 -1.125 1.429c0 1.83 2 2.058 2 3.571z" />
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        </svg>
                        {{ __('Import From Wordpress') }}
                    </a>
                </li>
            </ul>

        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-import-form-blogger">
                    <h4>{{ __('Import From Blogger') }}</h4>

                    <form action="" method="post" class="form-import">
                        @csrf

                        <input type="hidden" name="type" value="blogger">

                        <div class="progress mt-3 box-hidden form-progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="form-inputs">
                            <div class="form-group form-url">
                                <label class="col-form-label" for="url">File</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <span id="file-name"></span>
                                        <input type="hidden" name="file" id="url" class="form-control"
                                            autocomplete="off" value="">
                                    </div>

                                    <div class="col-md-2">
                                        <a href="javascript:void(0)" class="btn btn-primary file-manager" data-input="url"
                                            data-type="file" data-name="file-name"><i class="fa fa-upload"></i> Choose
                                            File</a>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-tabler">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-package-import">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                        <path d="M12 12l8 -4.5" />
                                        <path d="M12 12v9" />
                                        <path d="M12 12l-8 -4.5" />
                                        <path d="M22 18h-7" />
                                        <path d="M18 15l-3 3l3 3" />
                                    </svg>
                                </span>
                                Import</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="tabs-import-form-wordpress">
                    <h4>{{ __('Import From Wordpress') }}</h4>
                    <form action="" method="post" class="form-import">
                        @csrf

                        <input type="hidden" name="type" value="wordpress">

                        <div class="progress mt-3 box-hidden form-progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="form-inputs">
                            <div class="form-group form-url">
                                <label class="col-form-label" for="wordpress-url">File</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <span id="wordpress-file-name"></span>
                                        <input type="hidden" name="file" id="wordpress-url" class="form-control"
                                            autocomplete="off" value="">
                                    </div>

                                    <div class="col-md-2">
                                        <a href="javascript:void(0)" class="btn btn-primary file-manager"
                                            data-input="wordpress-url" data-type="file"
                                            data-name="wordpress-file-name"><i class="fa fa-upload"></i> Choose File</a>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-tabler">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-package-import">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                        <path d="M12 12l8 -4.5" />
                                        <path d="M12 12v9" />
                                        <path d="M12 12l-8 -4.5" />
                                        <path d="M22 18h-7" />
                                        <path d="M18 15l-3 3l3 3" />
                                    </svg>
                                </span>
                                Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setProgress(parent, percent) {
            parent.find('.form-progress .progress-bar')
                .text(percent + '%')
                .css('width', percent + '%')
                .attr('aria-valuenow', percent);
        }

        function requestImport(url, data, parent) {
            ajaxRequest(url, data, {
                callback: function(response) {
                    if (response.data.next) {
                        setProgress(
                            parent,
                            Math.round(
                                (response.data.next.next_page / response.data.next.max_page) * 100
                            )
                        );
                        requestImport(url, data, parent);
                    } else {
                        setProgress(parent, 100);
                        show_message(response);
                    }
                },
                failCallback: function(response) {
                    setProgress(parent, 0);
                    show_message(response);
                }
            });
        }

        $('.form-import').on('submit', function(event) {
            if (event.isDefaultPrevented()) {
                return false;
            }

            event.preventDefault();

            var file = $(this).find('input[name=file]').val();
            var type = $(this).find('input[name=type]').val();

            if (!file || !type) {
                return false;
            }

            //$(this).find('.form-inputs').hide('slow');
            //$(this).find('.form-progress').show('slow');

            requestImport("", {
                file: file,
                type: type
            }, $(this));
            return false;
        });
    </script>
@endsection
