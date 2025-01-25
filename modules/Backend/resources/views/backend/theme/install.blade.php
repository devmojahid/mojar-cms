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
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
              Upload Theme
            </a>
          </li>
          <li class="nav-item ms-auto">
            <button type="button" class="btn btn-tabler" id="upload-theme">
              <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
              {{ trans('cms::app.upload_theme') }}
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
                        <div class="form-group">
                            <div class="controls text-center">
                                <div class="input-group w-100">
                                    <a class="btn btn-primary w-100 text-white"
                                        id="theme-upload-button">{{ trans('cms::filemanager.message-choose') }}</a>
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

    {{-- <div class="row box-hidden mb-2" id="form-theme-upload">
        <div class="col-md-12">
            <form action="{{ route('admin.theme.install.upload') }}" role="form" id="themeUploadForm" name="themeUploadForm"
                method="post" class="dropzone" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="controls text-center">
                        <div class="input-group w-100">
                            <a class="btn btn-primary w-100 text-white"
                                id="theme-upload-button">{{ trans('cms::filemanager.message-choose') }}</a>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div> --}}

    <script>
        function themeItemFormatter(index, row) {
            let installBtn =
                `<button class="btn btn-primary install-theme" data-theme="${row.name}"> ${mojar.lang.install}</button>`;

            if (row.is_paid && !row.is_purchased) {
                installBtn =
                    `<button class="btn btn-success buy-theme" data-theme="${row.name}"> ${mojar.lang.buy} (${row.price})</button>`;
            }

            return `<div class="col-md-4">
                <div class="card">
                    <div
                        class="height-200 d-flex flex-column jw__g13__head"
                        style="background-repeat: no-repeat;
    background-size: 395px 200px;background-image: url('${row.screenshot}')">
                    </div>

                    <div class="card card-borderless mb-0">
                        <div class="card-header border-bottom-0">
                            <div class="d-flex">
                                <div class="text-dark text-uppercase font-weight-bold mr-auto">
                                    ${row.title}
                                </div>
                                <div class="text-gray-6">
                                    ${installBtn}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        // const listView = new MojarListView({
        //     url: "{{ route('admin.theme.install.all') }}",
        //     list: "#theme-list",
        //     page_size: 9,
        //     item_formatter: "themeItemFormatter"
        // });

        Dropzone.autoDiscover = false;

        $(function() {
            new Dropzone("#themeUploadForm", {
                uploadMultiple: false,
                parallelUploads: 5,
                timeout: 0,
                clickable: '#theme-upload-button',
                dictDefaultMessage: "{{ trans('cms::filemanager.message-drop') }}",
                init: function() {
                    this.on('success', function(file, response) {
                        if (response.status == false) {
                            this.defaultOptions.error(file, response.data.message);
                        }
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
