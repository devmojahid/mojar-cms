@extends('cms::layouts.backend')

@section('content')
    <div class="col-md-12 col-lg-12 plugin-install-container">
        <div class="card">
            <div class="card-header p-0 p-sm-2">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)">
                            <span>Free Plugins</span>
                        </a>
                    </li>
                    <li class="nav-item ms-auto">
                        <button type="button" class="btn btn-tabler" id="upload-plugin">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            </svg>
                            <span class="d-none d-sm-inline">{{ trans('cms::app.upload_plugin') }}</span>
                            <span class="d-sm-none">Upload</span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="plugin-upload-form">
                    <div class="row box-hidden mb-2" id="form-plugin-upload" style="display: none;">
                        <div class="col-md-12">
                            <form action="{{ route('admin.plugin.install.upload') }}" role="form" id="pluginUploadForm"
                                name="pluginUploadForm" method="post" class="dropzone dropzone-plugin"
                                enctype="multipart/form-data">
                                <div class="upload-wrapper">
                                    <div class="upload-content text-center">
                                        <div class="upload-icon mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                <path d="M7 9l5 -5l5 5"></path>
                                                <path d="M12 4l0 12"></path>
                                            </svg>
                                        </div>
                                        <h3 class="upload-title mb-2">{{ trans('cms::filemanager.message-choose') }}</h3>
                                        <p class="text-muted mb-3">Drag and drop your plugin ZIP file here or click to
                                            browse
                                        </p>
                                        <div class="upload-actions">
                                            <button type="button" class="btn btn-primary btn-lg px-4"
                                                id="plugin-upload-button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                    <path d="M7 9l5 -5l5 5"></path>
                                                    <path d="M12 4l0 12"></path>
                                                </svg>
                                                <span class="d-none d-sm-inline">Upload Plugin</span>
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
                                                <div class="progress-bar bg-primary" style="width: 0%" role="progressbar"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
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
        <div class="col-12 col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <!-- Thumbnail -->
                        <div class="col-4 col-sm-3">
                            <img src="{thumbnail}"
                                onerror="this.onerror=null; this.src='{{ asset('jw-styles/mojar/images/screenshot.svg') }}'"
                                alt="{title}" class="rounded img-fluid w-100">
                        </div>

                        <!-- Content -->
                        <div class="col-8 col-sm-7">
                            <h3 class="card-title h4 mb-1 text-truncate">
                                {title}
                            </h3>
                            <div class="text-secondary mb-2 text-wrap"
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {description}
                            </div>
                            <div class="mt-2">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <span class="text-muted">{version}</span>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" style="width: 0%" role="progressbar"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" aria-label="0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div
                            class="col-12 col-sm-2 d-flex justify-content-start justify-content-sm-end align-items-center mt-2 mt-sm-0">
                            <button class="btn btn-primary install-plugin w-100 w-sm-auto" data-plugin="{name}">
                                {{ trans('cms::app.install') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
        // Initialize listView globally
        var listView = new MojarListView({
            url: "{{ route('admin.plugin.install.all') }}",
            list: "#plugin-list",
            template: "plugin-template"
        });

        // Helper function to show notifications
        function showNotification(response) {
            if (typeof juzaweb !== 'undefined' && typeof juzaweb.message !== 'undefined') {
                juzaweb.message(response);
            } else {
                CustomToast.show({
                    title: response.status ? 'Success!' : 'Error!',
                    message: response.message,
                    type: response.status ? 'success' : 'error',
                    duration: 4000,
                    onClose: function() {
                        // Optional callback when toast is closed
                        //
                    }
                });
            }
        }

        // Function to refresh plugin list
        function refreshPluginList() {
            $.ajax({
                url: "{{ route('admin.plugin.install.all') }}",
                type: 'GET',
                success: function(response) {
                    $('#plugin-list').empty();
                    if (response && response.data) {
                        console.log(response.data);
                        response.data.forEach(function(plugin) {
                            let template = $('#plugin-template').html();
                            template = template.replace(/{title}/g, plugin.title)
                                .replace(/{description}/g, plugin.description)
                                .replace(/{version}/g, plugin.version)
                                .replace(/{name}/g, plugin.name)
                                .replace(/{thumbnail}/g, plugin.thumbnail);
                            $('#plugin-list').append(template);
                        });
                    }
                }
            });
        }

        $(function() {
            // Initialize Dropzone
            const initDropzone = () => {
                if (typeof Dropzone === 'undefined' || !document.getElementById('pluginUploadForm')) {
                    return;
                }

                Dropzone.autoDiscover = false;

                if (Dropzone.instances.length > 0) {
                    Dropzone.instances.forEach(instance => {
                        try {
                            instance.destroy();
                        } catch (e) {
                            console.warn('Error destroying Dropzone instance:', e);
                        }
                    });
                }

                try {
                    const dropzone = new Dropzone("#pluginUploadForm", {
                        uploadMultiple: false,
                        parallelUploads: 5,
                        timeout: 0,
                        clickable: '#plugin-upload-button',
                        dictDefaultMessage: "{{ trans('cms::filemanager.message-drop') }}",
                        init: function() {
                            this.on('addedfile', function(file) {
                                $('.upload-content').hide();
                                $('.upload-progress').show();
                            });

                            this.on('uploadprogress', function(file, progress) {
                                //
                            });

                            this.on('success', function(file, response) {
                                if (response.status === false) {
                                    const errorMessage = response.data?.message || response
                                        .message || 'Upload failed';
                                    showNotification({
                                        status: false,
                                        message: errorMessage
                                    });
                                } else {
                                    showNotification({
                                        status: true,
                                        message: response.message ||
                                            'Plugin uploaded successfully!'
                                    });
                                }

                                setTimeout(() => {
                                    $('.upload-progress').hide();
                                    $('.upload-content').show();
                                    this.removeAllFiles();
                                    if (response.status) {
                                        // Refresh the plugin list
                                        refreshPluginList();
                                    }
                                }, 1500);
                            });

                            this.on('error', function(file, errorMessage) {
                                let message = typeof errorMessage === 'object' ?
                                    (errorMessage.data?.message || errorMessage.message) :
                                    errorMessage;

                                showNotification({
                                    status: false,
                                    message: message
                                });

                                $('.upload-progress').hide();
                                $('.upload-content').show();
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
                } catch (error) {
                    console.error('Error initializing Dropzone:', error);
                    showNotification({
                        status: false,
                        message: 'Failed to initialize upload functionality'
                    });
                }
            };

            // Initialize Dropzone
            initDropzone();

            // Handle upload plugin button click
            $('#upload-plugin').on('click', function() {
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
