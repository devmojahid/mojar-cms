<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#333844">
    <meta name="msapplication-navbutton-color" content="#333844">
    <meta name="apple-mobile-web-app-status-bar-style" content="#333844">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('cms::filemanager.title-page') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('jw-styles/mojar/images/favicon.ico') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('jw-styles/mojar/css/filemanager.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jw-styles/mojar/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jw-styles/base/assets/css/tabler.min.css') }}">

    <style>
        .grid {
            display: flex;
            flex-wrap: wrap;
            padding: .5rem;
            justify-content: center;
        }
    </style>

<body class="mojar-cms-filemanager">

    <nav class="bg-light fixed-bottom border-top d-none" id="actions">
        <a data-action="open" data-multiple="false"><i
                class="fa fa-folder-open"></i>{{ trans('cms::filemanager.btn-open') }}
        </a>
        <a data-action="preview" data-multiple="true"><i
                class="fa fa-images"></i>{{ trans('cms::filemanager.menu-view') }}
        </a>
        <a data-action="use" data-multiple="true"><i class="fa fa-check"></i>{{ trans('cms::filemanager.btn-confirm') }}
        </a>
    </nav>

    {{-- start new file manager --}}
    <div class="card" id="media-container">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <h3 class="card-title text-capitalize mb-3 me-3">
                    {{ trans('cms::app.media_management') }}
                </h3>

                @if (!empty($breadcrumb) && is_array($breadcrumb))
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            @foreach ($breadcrumb as $crumb)
                                <li class="breadcrumb-item">
                                    <a href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a>
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                @endif
            </div>

            <div class="d-flex align-items-center">
                <form action="" method="get" class="d-flex align-items-center" style="gap: .5rem;">
                    <input type="text" class="form-control" name="search"
                        placeholder="{{ trans('cms::app.search_by_name') }}" autocomplete="off"
                        style="max-width: 180px;">

                    <select name="type" class="form-select">
                        <option value="">{{ trans('cms::app.all_type') }}</option>
                        @foreach ($fileTypes as $key => $val)
                            <option value="{{ $key }}" {{ $type == $key ? 'selected' : '' }}>
                                {{ strtoupper($key) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-tabler">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span>
                        {{ trans('cms::app.search') }}
                    </button>
                </form>
                <div class="btn-group mr-2 ml-2">
                    <div class="dropdown" data-bs-toggle="tooltip" title="{{ trans('cms::app.upload') }}">
                        <a href="#" class="btn dropdown-toggle btn-tabler" data-bs-toggle="dropdown">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 9l5 -5l5 5" />
                                    <path d="M12 4l0 12" />
                                </svg>
                            </span>
                            {{ trans('cms::app.upload') }}
                        </a>
                        <div class="dropdown-menu">
                            <label class="dropdown-item mb-0" for="local-file-upload">
                                <span class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                        <path d="M7 9l5 -5l5 5" />
                                        <path d="M12 4l0 12" />
                                    </svg>
                                </span>
                                Upload from local
                            </label>

                            <form action="{{ route('filemanager.upload') }}" role="form" id="uploadForm"
                                name="uploadForm" method="post" enctype="multipart/form-data" class="d-none">
                                <input type="file" id="local-file-upload" name="upload" style="display: none;"
                                    multiple accept="{{ implode(',', $mimeTypes) }}">
                                <input type="hidden" name="working_dir" class="working_dir">
                                <input type="hidden" name="type" class="type" value="{{ request('type') }}">
                                <input type="hidden" name="disk" class="disk"
                                    value="{{ request()->get('disk') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>


                            <a class="dropdown-item" href="#" data-toggle="modal"
                                data-target="#import-url-modal">
                                <span class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-link-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 15l6 -6" />
                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.072 0a4.993 4.993 0 0 1 -.001 7.072" />
                                        <path
                                            d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                    </svg>
                                </span>
                                Import from URL
                            </a>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-tabler" id="add-folder"
                        title="{{ trans('cms::app.add_folder') }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                            </svg>
                        </span>
                        {{ trans('cms::app.add_folder') }}
                    </button>
                </div>


            </div>
        </div>

        <div class="card-body main">
            {{-- <div id="tree"></div> --}}
            <div id="alerts"></div>

            <nav aria-label="breadcrumb" class="d-none d-lg-block" id="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item invisible">Home</li>
                </ol>
            </nav>

            <div id="empty" class="d-none">
                <i class="fa fa-folder-open"></i>
                {{ trans('cms::filemanager.message-empty') }}
            </div>
            <div id="content"></div>
            <div id="pagination"></div>

            <a id="item-template" class="d-none">
                <div class="square"></div>

                <div class="info">
                    <div class="item_name text-truncate"></div>
                    <time class="text-muted font-weight-light text-truncate"></time>
                </div>
            </a>
        </div>

    </div>

    <div class="modal fade" id="notify" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-100"
                        data-dismiss="modal">{{ trans('cms::filemanager.btn-close') }}</button>
                    <button type="button" class="btn btn-primary w-100"
                        data-dismiss="modal">{{ trans('cms::filemanager.btn-confirm') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-folder-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                            </svg>
                        </span>
                        {{ trans('cms::app.add_folder') }}
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ trans('cms::app.close') }}
                    </button>
                    <button type="button" class="btn btn-primary" onclick="addFolder()">
                        <span class="btn-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ trans('cms::app.add_folder') }}
                        </span>
                        <span class="btn-loader d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ trans('cms::app.creating') }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var lang = @json(trans('cms::filemanager'));
        var actions = [{
            name: 'trash',
            icon: 'trash',
            label: lang['menu-delete'],
            multiple: true
        }, ];

        const sortings = [{
                by: 'alphabetic',
                icon: 'sort-alpha-down',
                label: lang['nav-sort-alphabetic']
            },
            {
                by: 'time',
                icon: 'sort-numeric-down',
                label: lang['nav-sort-time']
            }
        ];

        let multi_selection_enabled =
            @if ($multiChoose == 1)
                true
            @else
                false
            @endif ;
    </script>
    <script src="{{ asset('jw-styles/mojar/js/filemanager.min.js') }}?v={{ \Juzaweb\CMS\Version::getVersion() }}">
    </script>
    <script src="{{ asset('jw-styles/mojar/js/vendor.min.js') }}"></script>
    <script src="{{ asset('jw-styles/base/assets/js/tabler.min.js') }}"></script>

    <script>
        function addFolder() {
            // hide modal
            $('#dialog').modal('hide');
            // refresh content
            loadItems();
        }

        document.getElementById('local-file-upload').addEventListener('change', function() {
            const formData = new FormData(document.getElementById('uploadForm'));
            const files = this.files;
            const loadingToast = "das";
            $.ajax({
                url: $('#uploadForm').attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            const progressPercent = (e.loaded / e.total) * 100;

                            // Update progress bar and size info
                            $('.progress-bar').css('width', progressPercent + '%');
                            $('.loaded-size').text(formatFileSize(e.loaded));

                            // Update current file info
                            $('.current-file').text(
                                `Uploading ${files.length} ${files.length > 1 ? 'files' : 'file'}...`
                            );
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    // loadingToast.close();

                    if (response === 'OK') {
                        loadItems();
                        console.log(response)
                    } else {
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred during upload';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMessage = response.message || errorMessage;
                    } catch (e) {
                        console.error('Error parsing response:', e);
                    }
                }
            });
        });

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function refreshMediaList() {
            $.ajax({
                url: window.location.href,
                type: 'GET',
                success: function(response) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(response, 'text/html');
                    const newContent = doc.querySelector('.jw-media-list');
                    if (newContent) {
                        document.querySelector('.jw-media-list').innerHTML = newContent.innerHTML;
                    }
                },
                error: function() {
                    console.error('Failed to refresh media list');
                    window.location = window.location.href;
                }
            });
        }
    </script>
</body>

</html>
