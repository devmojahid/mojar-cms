<div class="modal fade" id="upload-modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fa fa-cloud-upload me-2"></i>
                    {{ trans('cms::app.upload_files') }}
                </h5>
                <div class="modal-actions">
                    <button type="button" class="btn btn-icon" id="toggle-upload-options">
                        <i class="fa fa-cog"></i>
                    </button>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
            </div>
            @php
                $folders = $mediaFolders->where('parent_id', 0);
                $allowedTypes = ['image', 'video', 'document', 'audio', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp'];
            @endphp
            <div class="modal-body">
                <div class="upload-options collapse">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">{{ trans('cms::app.upload_location') }}</label>
                                <select class="form-select" id="upload-folder">
                                    <option value="">{{ trans('cms::app.root_folder') }}</option>
                                    @foreach($folders as $folder)
                                        <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="optimize-images">
                                    <span class="form-check-label">{{ trans('cms::app.optimize_images') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('filemanager.upload') }}" 
                      method="post" 
                      class="dropzone" 
                      id="uploadForm"
                      data-accepted-files=".jpg,.jpeg,.png,.gif,.svg,.webp,.mp4,.mp3,.pdf,.doc,.docx,.xls,.xlsx,.zip"
                      data-max-size="{{ $maxSize }}">
                    @csrf
                    <input type="hidden" name="folder_id" id="folder_id" value="">
                    <input type="hidden" name="optimize" id="optimize" value="0">
                    
                    <div class="upload-container">
                        <div class="upload-message">
                            <div class="upload-icon">
                                <i class="fa fa-cloud-upload"></i>
                                <div class="upload-icon-overlay">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <h3>{{ trans('cms::app.drag_files') }}</h3>
                            <p>{{ trans('cms::app.or_click_to_select') }}</p>
                            <div class="upload-limits">
                                <span>{{ trans('cms::app.max_file_size') }}: {{ $maxSize }}MB</span>
                                <span>{{ trans('cms::app.allowed_types') }}: {{ implode(', ', $allowedTypes) }}</span>
                            </div>
                            <button type="button" class="btn btn-primary btn-lg mt-3" id="upload-button">
                                <i class="fa fa-plus me-2"></i>
                                {{ trans('cms::app.select_files') }}
                            </button>
                        </div>

                        <div class="upload-preview">
                            <div class="upload-list"></div>
                            <div class="upload-template" id="upload-template">
                                <div class="upload-item">
                                    <div class="upload-thumbnail">
                                        <img data-dz-thumbnail />
                                        <div class="upload-overlay">
                                            <div class="upload-progress" data-dz-uploadprogress>
                                                <div class="progress-ring">
                                                    <svg viewBox="0 0 36 36">
                                                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                                    </svg>
                                                </div>
                                                <span class="progress-text" data-dz-percent></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="upload-details">
                                        <div class="upload-filename" data-dz-name></div>
                                        <div class="upload-info">
                                            <span class="upload-size" data-dz-size></span>
                                            <span class="upload-status"></span>
                                        </div>
                                        <div class="upload-error">
                                            <span class="text-danger" data-dz-errormessage></span>
                                        </div>
                                    </div>
                                    <div class="upload-actions">
                                        <button type="button" class="btn btn-icon" data-dz-remove>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <div class="upload-stats">
                    <div class="upload-progress-total">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <span class="upload-status-text">
                            <span class="upload-count">0</span> {{ trans('cms::app.files_selected') }}
                            (<span class="upload-size">0 KB</span>)
                        </span>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('cms::app.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
