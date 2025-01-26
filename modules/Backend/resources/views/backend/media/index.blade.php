@extends('cms::layouts.backend')

@section('content')
<div class="card" id="media-container">
    {{-- Card Header --}}
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <h3 class="card-title text-capitalize mb-0 me-3">
                {{ trans('cms::app.media_management') }}
            </h3>

            {{-- Example: Optional Breadcrumb (only if you have this logic/data) --}}
            @if(!empty($breadcrumb) && is_array($breadcrumb))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @foreach($breadcrumb as $crumb)
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
                <input
                    type="text"
                    class="form-control"
                    name="search"
                    placeholder="{{ trans('cms::app.search_by_name') }}"
                    autocomplete="off"
                    style="max-width: 180px;"
                >

                <select name="type" class="form-select">
                    <option value="">{{ trans('cms::app.all_type') }}</option>
                    @foreach($fileTypes as $key => $val)
                        <option value="{{ $key }}" {{ $type == $key ? 'selected' : '' }}>
                            {{ strtoupper($key) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-tabler">
                    <span>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                    </span>
                    {{ trans('cms::app.search') }}
                </button>
            </form>
            <div class="btn-group mr-2 ml-2">
                <div class="dropdown" data-bs-toggle="tooltip" title="{{ trans('cms::app.upload') }}">
                    <a href="#" class="btn dropdown-toggle btn-tabler" data-bs-toggle="dropdown">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                        </span>
                        {{ trans('cms::app.upload') }}
                    </a>
                    <div class="dropdown-menu">
                        <label class="dropdown-item mb-0" for="local-file-upload">
                            <span class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                            </span>
                            Upload from local
                        </label>
                        <input
                            type="file"
                            id="local-file-upload"
                            style="display: none;"
                            multiple
                            accept="{{ implode(',', $mimeTypes) }}"
                        >
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import-url-modal">
                            <span class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.072 0a4.993 4.993 0 0 1 -.001 7.072" /><path d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                            </span>
                            Import from URL
                        </a>
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <button
                    type="button"
                    class="btn btn-tabler"
                    data-toggle="modal"
                    data-target="#add-folder-modal"
                    data-bs-toggle="tooltip"
                    title="{{ trans('cms::app.add_folder') }}"
                >
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-folder"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" /></svg>
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
            <div class="col-md-9">
                <div class="jw-list-media">
                    <ul class="jw-media-list">
                        @forelse($mediaFolders as $item)
                            @component('cms::backend.media.components.item', ['item' => $item])
                            @endcomponent
                        @empty
                            {{-- If no folders found --}}
                        @endforelse

                        @forelse($mediaFiles as $item)
                            @component('cms::backend.media.components.item', ['item' => $item])
                            @endcomponent
                        @empty
                            {{-- If no files found --}}
                        @endforelse
                    </ul>

                    {{-- If absolutely nothing is in the folder, show a small placeholder --}}
                    @if($mediaFolders->isEmpty() && $mediaFiles->isEmpty())
                        <div class="alert alert-secondary mt-3" role="alert">
                            {{ trans('cms::app.no_files_or_folders') }}
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    {{ $mediaFiles->appends(request()->query())->links() }}
                </div>
            </div>

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
@endsection

@section('footer')
    {{-- Template for file detail preview --}}
    <template id="media-detail-template">
        <div class="jw-file-box-image mb-3">
            <img src="{url}" alt="" class="jw-preview-image">
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ str_replace('__ID__', '{id}', route('admin.media.download', ['__ID__'])) }}" class="text-decoration-none">
                {{ trans('cms::app.download') }}
            </a>
            <a
                href="javascript:void(0)"
                class="text-danger text-decoration-none delete-file"
                data-id="{id}"
                data-is_file="{is_file}"
                data-name="{name}"
            >
                {{ trans('cms::app.delete') }}
            </a>
        </div>

        <form
            action="{{ str_replace('__ID__', '{id}', route('admin.media.update', ['__ID__'])) }}"
            method="post"
            class="form-ajax"
        >
            @method('put')
            <input type="hidden" name="is_file" value="{is_file}">

            {{ Field::text(trans('cms::app.name'), 'name', ['value' => '{name}']) }}

            {{ Field::text(trans('cms::app.url'), 'url', ['value' => '{url}', 'disabled' => true]) }}

            <table class="table table-sm">
                <tbody>
                <tr>
                    <td>{{ trans('cms::app.extension') }}</td>
                    <td>{extension}</td>
                </tr>
                <tr>
                    <td>{{ trans('cms::app.size') }}</td>
                    <td>{size}</td>
                </tr>
                <tr>
                    <td>{{ trans('cms::app.last_update') }}</td>
                    <td>{updated}</td>
                </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary mb-2">
                {{ trans('cms::app.save') }}
            </button>
        </form>
    </template>
    @include('cms::backend.media.components.add_modal')

    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function () {
            // Initialize Dropzone
            new Dropzone("#uploadForm", {
                paramName: "upload",
                uploadMultiple: false,
                parallelUploads: 5,
                timeout: 0,
                clickable: '#upload-button',
                dictDefaultMessage: "{{ trans('cms::filemanager.message-drop') }}",
                init: function () {
                    this.on('success', function (file, response) {
                        if (response == 'OK') {
                            window.location = "";
                        } else {
                            this.defaultOptions.error(file, response.join('\n'));
                        }
                    });
                },
                headers: {
                    'Authorization': "Bearer {{ csrf_token() }}"
                },
                acceptedFiles: "{{ implode(',', $mimeTypes) }}",
                maxFilesize: parseInt("{{ $maxSize }}"),
                chunking: true,
                chunkSize: 1048576,
            });

            // Initialize tooltips (Bootstrap 4 or 5)
            $('[data-bs-toggle="tooltip"]').tooltip();

        });

        // After folder creation success
        function add_folder_success(form) {
            window.location = "";
        }

        $(document).ready(function() {
            // Function to truncate filename while preserving extension
            function truncateFileName(fileName, maxLength = 100) {
                const extension = fileName.split('.').pop();
                const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));

                if (nameWithoutExt.length + extension.length + 1 <= maxLength) {
                    return fileName;
                }

                // Calculate available space for name considering extension and dot
                const maxNameLength = maxLength - extension.length - 1;
                const truncatedName = nameWithoutExt.substring(0, maxNameLength);

                return `${truncatedName}.${extension}`;
            }

            // Function to sanitize filename
            function sanitizeFileName(fileName) {
                // Remove special characters and spaces, replace with hyphens
                return fileName
                    .toLowerCase()
                    .replace(/[^\w\-\.]/g, '-')  // Replace special chars with hyphen
                    .replace(/\s+/g, '-')        // Replace spaces with hyphen
                    .replace(/-+/g, '-')         // Replace multiple hyphens with single hyphen
                    .replace(/^-+/, '')          // Remove hyphens from start
                    .replace(/-+$/, '');         // Remove hyphens from end
            }

            // Handle direct file upload
            $('#local-file-upload').on('change', function(e) {
                const files = e.target.files;
                if (!files.length) return;

                const formData = new FormData();
                formData.append('working_dir', '{{ $folderId }}');
                formData.append('type', '{{ $type }}');
                formData.append('_token', '{{ csrf_token() }}');

                // Calculate total size for progress tracking
                let totalSize = 0;
                let loadedSize = 0;

                // Process each file
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    totalSize += file.size;

                    // Sanitize and truncate the filename
                    const sanitizedName = sanitizeFileName(file.name);
                    const truncatedName = truncateFileName(sanitizedName, 100);

                    const processedFile = new File([file], truncatedName, {
                        type: file.type,
                        lastModified: file.lastModified
                    });

                    formData.append('upload', processedFile);
                }

                // Show enhanced loading indicator with progress
                const loadingToast = Swal.fire({
                    title: `Uploading ${files.length} ${files.length > 1 ? 'files' : 'file'}...`,
                    html: `
                        <div class="upload-progress-container">
                            <div class="current-file mb-2">Preparing upload...</div>
                            <div class="progress" style="height: 0.5rem;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: 0%"
                                     aria-valuenow="0"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <div class="size-info mt-2">
                                <small class="text-muted">
                                    <span class="loaded-size">0</span> / <span class="total-size">${formatFileSize(totalSize)}</span>
                                </small>
                            </div>
                        </div>
                    `,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send upload request with progress tracking
                $.ajax({
                    url: '{{ route('filemanager.upload') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                loadedSize = e.loaded;
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
                        loadingToast.close();

                        if (response === 'OK') {
                            const successToast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'notification-toast'
                                },
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });

                            successToast.fire({
                                icon: 'success',
                                title: `Successfully uploaded ${files.length} ${files.length > 1 ? 'files' : 'file'}`
                            }).then(() => {
                                // Refresh the media list without page reload
                                refreshMediaList();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: Array.isArray(response) ? response.join('\n') : 'An error occurred during upload',
                                confirmButtonText: 'Try Again',
                                customClass: {
                                    popup: 'notification-toast'
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        loadingToast.close();

                        let errorMessage = 'An error occurred during upload';
                        try {
                            const response = JSON.parse(xhr.responseText);
                            errorMessage = response.message || errorMessage;
                        } catch (e) {
                            console.error('Error parsing response:', e);
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: errorMessage,
                            confirmButtonText: 'Try Again',
                            showCancelButton: true,
                            cancelButtonText: 'Cancel'
                        });
                    }
                });

                // Clear the input
                $(this).val('');
            });

            // Helper function to format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Function to refresh media list via AJAX
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
                        // Fallback to soft reload
                        window.location = window.location.href;
                    }
                });
            }
        });
    </script>

    <div class="modal fade" id="import-url-modal" tabindex="-1" role="dialog" aria-labelledby="import-url-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="import-url-modal-label">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.072 0a4.993 4.993 0 0 1 -.001 7.072" /><path d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                        </span>
                        {{ trans('cms::app.file_manager.upload_from_url') }}
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="url-upload-form" class="form-ajax">
                        <div class="mb-3">
                            <label class="form-label">{{ trans('cms::app.url') }}</label>
                            <input type="url" name="url" class="form-control" required
                                   placeholder="https://example.com/image.jpg">
                            <div class="form-text">{{ trans('cms::app.file_manager.url_upload_hint') }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="download" class="form-check-input"
                                       value="1" id="download-checkbox" checked>
                                <label class="form-check-label" for="download-checkbox">
                                    {{ trans('cms::app.file_manager.download_to_server') }}
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="working_dir" value="{{ $folderId }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="url-upload-progress d-none">
                            <div class="upload-progress-container">
                                <div class="current-file mb-2">Preparing download...</div>
                                <div class="progress" style="height: 0.5rem;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" style="width: 0%">
                                    </div>
                                </div>
                                <div class="size-info mt-2">
                                    <small class="text-muted">
                                        <span class="loaded-size">0</span> / <span class="total-size">Unknown</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('cms::app.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary" form="url-upload-form">
                        <span class="btn-text">{{ trans('cms::app.file_manager.upload_file') }}</span>
                        <span class="btn-loader d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ trans('cms::app.uploading') }}...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Move these functions outside document.ready to make them globally available
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
                // Fallback to soft reload
                window.location = window.location.href;
            }
        });
    }

    // Custom success notification function
    function showSuccessNotification(message) {
        Swal.fire({
            text: message,
            icon: 'success',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'notification-toast'
            }
        });
    }

    // Custom error notification function
    function showErrorNotification(message) {
        Swal.fire({
            text: message,
            icon: 'error',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'notification-toast'
            }
        });
    }

    $(document).ready(function() {
        // URL Upload Handler
        $('#url-upload-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const progressContainer = form.find('.url-upload-progress');
            const url = form.find('input[name="url"]').val();

            // Show progress container
            progressContainer.removeClass('d-none');
            submitBtn.prop('disabled', true)
                .find('.btn-text').addClass('d-none')
                .end()
                .find('.btn-loader').removeClass('d-none');

            // Prepare form data
            const formData = new FormData(form[0]);

            $.ajax({
                url: '{{ route('filemanager.import') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            const percent = (e.loaded / e.total) * 100;
                            progressContainer.find('.progress-bar').css('width', percent + '%');
                            progressContainer.find('.loaded-size').text(formatFileSize(e.loaded));
                            progressContainer.find('.total-size').text(formatFileSize(e.total));
                            progressContainer.find('.current-file').text('Uploading file from URL...');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    $('#import-url-modal').modal('hide');
                    showSuccessNotification('File successfully imported from URL');
                    refreshMediaList();

                    // Reset form
                    form[0].reset();
                    progressContainer.addClass('d-none');
                    submitBtn.prop('disabled', false)
                        .find('.btn-text').removeClass('d-none')
                        .end()
                        .find('.btn-loader').addClass('d-none');
                },
                error: function(xhr) {
                    let errorMessage = 'Failed to import file from URL';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMessage = response.message || errorMessage;
                    } catch (e) {
                        console.error('Error parsing response:', e);
                    }

                    showErrorNotification(errorMessage);

                    // Reset button state
                    submitBtn.prop('disabled', false)
                        .find('.btn-text').removeClass('d-none')
                        .end()
                        .find('.btn-loader').addClass('d-none');
                }
            });
        });

        // Reset modal on close
        $('#import-url-modal').on('hidden.bs.modal', function() {
            const form = $('#url-upload-form');
            form[0].reset();
            form.find('.url-upload-progress').addClass('d-none');
            form.find('button[type="submit"]')
                .prop('disabled', false)
                .find('.btn-text').removeClass('d-none')
                .end()
                .find('.btn-loader').addClass('d-none');
        });
    });
    </script>
@endsection
