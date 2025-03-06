<div class="modal fade" id="add-folder-modal" tabindex="-1" role="dialog" aria-labelledby="add-folder-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <form action="{{ route('admin.media.add-folder') }}" method="post" class="form-ajax"
            data-success="add_folder_success" id="add-folder-form" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-folder-modal-label">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-folder-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                            </svg>
                        </span>
                        {{ trans('cms::app.add_folder') }}
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                        aria-label="{{ trans('cms::app.close') }}"></button>
                </div>

                <div class="modal-body">
                    <div class="folder-info mb-4">
                        <div class="mb-3">
                            <label class="form-label">{{ trans('cms::app.folder_name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                                    </svg>
                                </span>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ trans('cms::app.enter_folder_name') }}" required
                                    pattern="[a-zA-Z0-9-_]+" title="{{ trans('cms::app.folder_name_validation') }}">
                            </div>
                            <div class="form-text text-muted">
                                {{ trans('cms::app.folder_name_hint') }}
                            </div>
                        </div>

                        <div class="current-path mb-3">
                            <label class="form-label text-muted">{{ trans('cms::app.current_location') }}</label>
                            <div class="path-display p-2 bg-light rounded">
                                <small class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-folder me-1">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                                    </svg>
                                    {{ $folderId ? 'Current Folder' : 'Root' }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="folder_id" value="{{ $folderId }}">
                    <input type="hidden" name="type" value="{{ $type }}">

                    <div class="folder-create-progress d-none">
                        <div class="progress-container">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: 100%">
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block text-center">
                                {{ trans('cms::app.creating_folder') }}...
                            </small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('cms::app.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ trans('cms::app.add_folder') }}
                        </span>
                        <span class="btn-loader d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ trans('cms::app.creating') }}...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        const addFolderForm = $('#add-folder-form');
        const submitBtn = addFolderForm.find('button[type="submit"]');
        const progressContainer = addFolderForm.find('.folder-create-progress');
        const folderNameInput = addFolderForm.find('input[name="name"]');

        // Enhanced form submission with AJAX
        addFolderForm.on('submit', function(e) {
            e.preventDefault();

            submitBtn.prop('disabled', true)
                .find('.btn-text').addClass('d-none')
                .end()
                .find('.btn-loader').removeClass('d-none');
            progressContainer.removeClass('d-none');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Reset form and button state first
                    addFolderForm[0].reset();
                    submitBtn.prop('disabled', false)
                        .find('.btn-text').removeClass('d-none')
                        .end()
                        .find('.btn-loader').addClass('d-none');
                    progressContainer.addClass('d-none');

                    // Hide modal
                    $('#add-folder-modal').modal('hide');

                    // Show success notification
                    Swal.fire({
                        text: '{{ trans('cms::app.folder_created_successfully') }}',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        customClass: {
                            popup: 'notification-toast'
                        }
                    });

                    // Refresh media list without page reload
                    refreshMediaList();
                },
                error: function(xhr) {
                    let errorMessage = '{{ trans('cms::app.folder_creation_failed') }}';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMessage = response.message || errorMessage;
                    } catch (e) {
                        console.error('Error parsing response:', e);
                    }

                    Swal.fire({
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: '{{ trans('cms::app.ok') }}'
                    });

                    // Reset button state
                    submitBtn.prop('disabled', false)
                        .find('.btn-text').removeClass('d-none')
                        .end()
                        .find('.btn-loader').addClass('d-none');
                    progressContainer.addClass('d-none');
                }
            });
        });

        // Real-time folder name validation
        folderNameInput.on('input', function() {
            const value = $(this).val();
            const sanitized = value.replace(/[^a-zA-Z0-9-_]/g, '-');
            if (value !== sanitized) {
                $(this).val(sanitized);
            }
        });

        // Reset form on modal close
        $('#add-folder-modal').on('hidden.bs.modal', function() {
            addFolderForm[0].reset();
            submitBtn.prop('disabled', false)
                .find('.btn-text').removeClass('d-none')
                .end()
                .find('.btn-loader').addClass('d-none');
            progressContainer.addClass('d-none');
        });

        // Focus input when modal opens
        $('#add-folder-modal').on('shown.bs.modal', function() {
            folderNameInput.focus();
        });
    });
</script>
