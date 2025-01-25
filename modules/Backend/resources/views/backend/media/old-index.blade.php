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

                <button type="submit" class="btn btn-primary">
                    {{ trans('cms::app.search') }}
                </button>
            </form>

            <div class="btn-group ms-3">
                <button 
                    type="button" 
                    class="btn btn-success" 
                    data-toggle="modal" 
                    data-target="#add-folder-modal"
                    data-bs-toggle="tooltip"
                    title="{{ trans('cms::app.add_folder') }}"
                >
                    <i class="fa fa-plus"></i> 
                </button>
                <button 
                    type="button" 
                    class="btn btn-success" 
                    data-toggle="modal" 
                    data-target="#upload-modal"
                    data-bs-toggle="tooltip"
                    title="{{ trans('cms::app.upload') }}"
                >
                    <i class="fa fa-cloud-upload"></i>
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
    @include('cms::backend.media.components.upload_modal')

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
    </script>
@endsection