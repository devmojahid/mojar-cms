@extends('cms::layouts.backend')

@section('content')

<div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              Themes
            </a>
          </li>
          <li class="nav-item ms-auto">
            <button type="button" class="btn btn-tabler" id="upload-theme">
              <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
              <span class="d-none d-sm-inline">{{ trans('cms::app.upload_theme') }}</span>
              <span class="d-sm-none">Upload</span>
            </button>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="theme-upload-form">
            <div class="row box-hidden mb-2" id="form-theme-upload" style="display: none;">
                <div class="col-md-12">
                    <form action="{{ route('admin.theme.install.upload') }}" role="form" id="themeUploadForm"
                        name="themeUploadForm" method="post" class="dropzone" enctype="multipart/form-data">
                        <div class="upload-wrapper">
                            <div class="upload-content text-center">
                                <div class="upload-icon mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 9l5 -5l5 5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                </div>
                                <h3 class="upload-title mb-2">{{ trans('cms::filemanager.message-choose') }}</h3>
                                <p class="text-muted mb-3">Drag and drop your theme ZIP file here or click to browse</p>
                                <div class="upload-actions">
                                    <button type="button" class="btn btn-primary btn-lg px-4" id="theme-upload-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M7 9l5 -5l5 5"></path>
                                            <path d="M12 4l0 12"></path>
                                        </svg>
                                        <span class="d-none d-sm-inline">Browse Files</span>
                                    </button>
                                </div>
                                <div class="upload-info mt-3">
                                    <small class="text-muted">Maximum upload file size: 1024MB (1GB)</small>
                                </div>
                            </div>
                            <div class="upload-progress" style="display: none;">
                                <div class="progress-wrapper">
                                    <div class="progress-info mb-2">
                                        <div class="progress-label">
                                            <span class="text-primary">Uploading...</span>
                                        </div>
                                        <div class="progress-percentage">
                                            <span>0%</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
        <div class="row" id="theme-list"></div>
      </div>
    </div>
  </div>

    <script>
        function themeItemFormatter(index, row) {
            let installBtn =
                `<button class="btn btn-tabler install-theme" data-theme="${row.name}"> ${mojar.lang.install}</button>`;

            if (row.is_paid && !row.is_purchased) {
                installBtn =
                    `<button class="btn btn-tabler buy-theme" data-theme="${row.name}"> ${mojar.lang.buy} (${row.price})</button>`;
            }

            return `<div class="col-lg-4 theme-list-item">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">
                                    ${row.title}
                                </h3>
                                <div class="card-actions">
                                    ${installBtn}
                                </div>
                            </div>
                            <div class="card-body">
                                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    data-src="${row.screenshot}" alt="${row.title}"
                                    class="lazyload w-100 h-100">
                            </div>
                            <div class="card-footer">
                                <div class="mb-3">
                                    <div class="text-muted">
                                        ${row?.author ? `<div class="d-flex align-items-center mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>
                                            <span>${row?.author || 'Unknown'}</span>
                                        </div>` : ''}   
                                        ${row?.version ? `<div class="d-flex align-items-center mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                                                <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                                                <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                                                <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                                                <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" />
                                            </svg>
                                            <span>v ${row?.version || 'Unknown'}</span>
                                        </div>` : ''}
                                        ${row?.description ? `<div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                                <line x1="8" y1="9" x2="16" y2="9" />
                                                <line x1="8" y1="13" x2="14" y2="13" />
                                            </svg>
                                            <span>${row?.description || ''}</span>
                                        </div>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
            }

        const listView = new MojarListView({
            url: "{{ route('admin.theme.install.all') }}",
            list: "#theme-list",
            page_size: 9,
            item_formatter: "themeItemFormatter"
        });

        Dropzone.autoDiscover = false;

        $(function() {
            new Dropzone("#themeUploadForm", {
                uploadMultiple: false,
                parallelUploads: 5,
                timeout: 0,
                clickable: '#theme-upload-button',
                dictDefaultMessage: "{{ trans('cms::filemanager.message-drop') }}",
                init: function() {
                    this.on('addedfile', function(file) {
                        $('.upload-content').hide();
                        $('.upload-progress').show();
                    });

                    console.log('ready');

                    this.on('uploadprogress', function(file, progress) {
                        $('.progress-bar').width(progress + '%');
                        $('.progress-percentage span').text(Math.round(progress) + '%');
                    });

                    this.on('success', function(file, response) {
                        if (response.status == false) {
                            this.defaultOptions.error(file, response.data.message);
                        } else {
                            setTimeout(() => {
                                $('.upload-progress').hide();
                                $('.upload-content').show();
                                this.removeAllFiles();
                            }, 1500);
                        }
                    });
                    this.on('error', function(file, errorMessage) {
                        $('.upload-progress').hide();
                        $('.upload-content').show();
                        alert(errorMessage);
                        this.removeAllFiles();
                    });
                },
                headers: {
                    'Authorization': "Bearer {{ csrf_token() }}"
                },
                acceptedFiles: "application/zip,.zip",
                maxFilesize: 1024,
                chunking: true,
                chunkSize: 1048576,
            });

            $('body').on('click', '#upload-theme', function() {
                let frm = $('#form-theme-upload');
                if (frm.is(':hidden')) {
                    frm.show('slow');
                } else {
                    frm.hide('slow');
                }
            });
        });
    </script>
@endsection
