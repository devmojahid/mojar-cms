<div class="modal fade" id="add-folder-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fa fa-folder-plus me-2"></i>
                    {{ trans('cms::app.add_folder') }}
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            @php
                $folders = $mediaFolders->where('parent_id', 0);
            @endphp
            <form action="#"
            {{-- action="{{ route('admin.media.folder.store') }}"  --}}
                  method="post" 
                  class="form-ajax"
                  data-success="add_folder_success">
                @csrf
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">
                            {{ trans('cms::app.folder_name') }}
                        </label>
                        <input type="text" 
                               name="name" 
                               class="form-control" 
                               required 
                               autofocus
                               pattern="[a-zA-Z0-9\-_\s]+"
                               title="{{ trans('cms::app.folder_name_rules') }}"
                               placeholder="{{ trans('cms::app.enter_folder_name') }}">
                        <div class="form-text">
                            {{ trans('cms::app.folder_name_hint') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            {{ trans('cms::app.parent_folder') }}
                        </label>
                        <select name="parent_id" class="form-select">
                            <option value="">{{ trans('cms::app.root_folder') }}</option>
                            @foreach($folders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('cms::app.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-2"></i>
                        {{ trans('cms::app.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
