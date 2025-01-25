@extends('cms::layouts.backend')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  Free Plugins
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon nav-link-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                  Premium Plugins
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                  Upload Plugin
                </a>
              </li>
              <li class="nav-item ms-auto">
                <button type="button" class="btn btn-tabler" id="upload-plugin">
                  <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                  {{ trans('cms::app.upload_plugin') }}
                </button>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="plugin-upload-form">
                <div class="row box-hidden mb-2" id="form-plugin-upload" style="display: none;">
                    <div class="col-md-12">
                        <form action="{{ route('admin.plugin.install.upload') }}" role="form" id="pluginUploadForm"
                            name="pluginUploadForm" method="post" class="dropzone" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="controls text-center">
                                    <div class="input-group w-100">
                                        <a class="btn btn-primary w-100 text-white"
                                            id="plugin-upload-button">{{ trans('cms::filemanager.message-choose') }}</a>
                                    </div>
                                </div>
                            </div>
            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row" id="plugin-list"></div>
          </div>
        </div>
      </div>


    <template id="plugin-template">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex flex-row mb-3">
                    <img src="{thumbnail}" alt="{title}" width="70" height="70">
                    <div class="d-flex flex-column ml-2">
                        <span>{title}</span>
                        {{-- <span class="text-black-50">Payment Services</span> --}}

                        <span class="ratings text-secondary">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                </div>
                <h6>{description}</h6>
                <div class="d-flex justify-content-between install mt-3">
                    {{-- <span>Installed 172 times</span> --}}
                    <button class="btn btn-primary install-plugin"
                        data-plugin="{name}">{{ trans('cms::app.install') }}</button>

                    {{-- <a target="_blank" href="{url}" class="text-primary">
                        {{ trans('cms::app.view') }}&nbsp;<i class="fa fa-angle-right"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </template>

    <script>
        // var listView = new MojarListView({
        //     url: "{{ route('admin.plugin.install.all') }}",
        //     list: "#plugin-list",
        //     template: "plugin-template"
        // });

        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            new Dropzone("#pluginUploadForm", {
                uploadMultiple: false,
                parallelUploads: 5,
                timeout: 0,
                clickable: '#plugin-upload-button',
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

            $('body').on('click', '#upload-plugin', function() {
                let frm = $('#form-plugin-upload');
                if (frm.is(':hidden')) {
                    frm.show('slow');
                } else {
                    frm.hide('slow');
                }
            });
        });
    </script>
@endsection
