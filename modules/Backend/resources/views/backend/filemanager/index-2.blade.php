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
    <link rel="stylesheet" href="{{ asset('jw-styles/mojar/css/filemanager.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jw-styles/base/assets/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jw-styles/base/assets/css/tabler-vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jw-styles/base/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>


<body>
    <div class="card" id="media-container">
        {{-- Card Header --}}
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <h3 class="card-title text-capitalize mb-0 me-3">
                    {{ trans('cms::app.media_management') }}
                </h3>

                {{-- Example: Optional Breadcrumb (only if you have this logic/data) --}}
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
                        {{-- @foreach ($fileTypes as $key => $val)
                            <option value="{{ $key }}" {{ $type == $key ? 'selected' : '' }}>
                                {{ strtoupper($key) }}
                            </option>
                        @endforeach --}}
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
                            <input type="file" id="local-file-upload" style="display: none;" multiple
                                accept="{{ implode(',', $mimeTypes) }}">
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
                    <button type="button" class="btn btn-tabler" data-toggle="modal"
                        data-target="#add-folder-modal" data-bs-toggle="tooltip"
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

        {{-- Card Body --}}
        <div class="card-body">
            <div class="row">
                {{-- Media List Section --}}
              

                {{-- Preview Panel --}}
                <div class="col-md-3">
                    <div id="preview-file" class="jw-preview-file">
                        <div class="jw-preview-placeholder">
                            <i class="fa fa-file-image-o"></i>
                        </div>
                        <p class="text-center">
                            {{ trans('cms::app.media_setting.click_file_to_view_info') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('jw-styles/mojar/js/vendor.min.js') }}"></script>
    <script src="{{ asset('jw-styles/base/assets/js/tabler.min.js') }}"></script>
</body>

</html>
