@extends('cms::layouts.backend')

@section('content')
    <div class="media-container">
        <!-- Quick Access Section -->
        <div class="quick-access-bar">
            <div class="quick-access-wrapper">
                <div class="breadcrumb-section">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.media.index') }}">
                                    <i class="fa fa-home"></i>
                                    {{ trans('cms::app.media') }}
                                </a>
                            </li>
                            @if(request()->has('folder'))
                                <li class="breadcrumb-item active">{{ $currentFolder->name }}</li>
                            @endif
                        </ol>
                    </nav>
                </div>

                @php
                    $totalFiles = $mediaFolders->count() + $mediaFiles->count();
                    $imageCount = $mediaFiles->where('type', 'image')->count();
                    $videoCount = $mediaFiles->where('type', 'video')->count();
                    $documentCount = $mediaFiles->where('type', 'document')->count();
                    $audioCount = $mediaFiles->where('type', 'audio')->count();
                @endphp

                <div class="quick-filters">
                    <a href="{{ route('admin.media.index') }}" 
                       class="quick-filter-item {{ !request('type') ? 'active' : '' }}">
                        <i class="fa fa-folder-o"></i>
                        {{-- {!! $svg-icons['all'] !!} --}}
                        <span>{{ trans('cms::app.all_media') }}</span>
                        <span class="badge">{{ $totalFiles }}</span>
                    </a>
                    
                    <a href="{{ route('admin.media.index', ['type' => 'image']) }}" 
                       class="quick-filter-item {{ request('type') === 'image' ? 'active' : '' }}">
                        <i class="fa fa-image"></i>
                        {{-- {!! $svg-icons['image'] !!} --}}
                        <span>{{ trans('cms::app.images') }}</span>
                        <span class="badge">{{ $imageCount }}</span>
                    </a>
                    
                    <a href="{{ route('admin.media.index', ['type' => 'video']) }}" 
                       class="quick-filter-item {{ request('type') === 'video' ? 'active' : '' }}">
                        <i class="fa fa-video-camera"></i>
                        <span>{{ trans('cms::app.videos') }}</span>
                        <span class="badge">{{ $videoCount }}</span>
                    </a>
                    
                    <a href="{{ route('admin.media.index', ['type' => 'document']) }}" 
                       class="quick-filter-item {{ request('type') === 'document' ? 'active' : '' }}">
                        <i class="fa fa-file-text-o"></i>
                        <span>{{ trans('cms::app.documents') }}</span>
                        <span class="badge">{{ $documentCount }}</span>
                    </a>
                    
                    <a href="{{ route('admin.media.index', ['type' => 'audio']) }}" 
                       class="quick-filter-item {{ request('type') === 'audio' ? 'active' : '' }}">
                        <i class="fa fa-music"></i>
                        <span>{{ trans('cms::app.audio') }}</span>
                        <span class="badge">{{ $audioCount }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Action Bar -->
        <div class="media-actions-bar">
            <div class="actions-left">
                <div class="btn-group action-buttons">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#upload-modal">
                        <i class="fa fa-cloud-upload me-2"></i>
                        <span>{{ trans('cms::app.upload') }}</span>
                    </button>
                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-folder-modal">
                                <i class="fa fa-folder-plus me-2"></i>
                                {{ trans('cms::app.add_folder') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <button class="btn btn-icon btn-secondary" title="{{ trans('cms::app.refresh') }}" onclick="window.location.reload()">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>

            <div class="actions-center">
                <form action="" method="get" class="d-flex gap-2">
                    <div class="input-icon search-box">
                        <input type="text" 
                               class="form-control" 
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="{{ trans('cms::app.search_by_name') }}">
                        <span class="input-icon-addon">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>

                    <select name="type" class="form-select" style="width: 120px">
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
            </div>

            <div class="actions-right">
                <div class="btn-group view-switcher">
                    <button class="btn btn-icon {{ request('view', 'grid') === 'grid' ? 'active' : '' }}" 
                            data-view="grid">
                        <i class="fa fa-th-large"></i>
                    </button>
                    <button class="btn btn-icon {{ request('view') === 'list' ? 'active' : '' }}" 
                            data-view="list">
                        <i class="fa fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Content Area -->
        <div class="media-content">
            <div class="media-list-container">
                <div class="list-media">
                    <div class="media-list {{ request('view', 'grid') }}-view">
                        @forelse(array_merge($mediaFolders->all(), $mediaFiles->all()) as $item)
                            @component('cms::backend.media.components.item', [
                                'item' => $item,
                                'view' => request('view', 'grid')
                            ])
                            @endcomponent
                        @empty
                            <div class="media-empty">
                                <i class="fa fa-folder-open-o"></i>
                                <p>{{ trans('cms::app.no_files_found') }}</p>
                            </div>
                        @endforelse
                    </div>

                    @if($mediaFiles->hasPages())
                        <div class="media-pagination">
                            {{ $mediaFiles->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Enhanced Preview Panel -->
            <div class="preview-panel" id="preview-file">
                <div class="preview">
                    <i class="fa fa-file-image-o"></i>
                    <p class="text-center text-muted">
                        {{ trans('cms::app.media_setting.click_file_to_view_info') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- File Preview Template -->
    <template id="media-detail-template">
        <div class="preview-header">
            <h3 class="preview-title">{name}</h3>
            <button type="button" class="btn btn-icon" id="close-preview">
                <i class="fa fa-times"></i>
            </button>
        </div>
        
        <div class="preview-content">
            <div class="preview-image">
                <img src="{url}" alt="{name}">
            </div>

            <div class="preview-info">
                <div class="preview-actions">
                    <a href="{{ str_replace('__ID__', '{id}', route('admin.media.download', ['__ID__'])) }}" 
                       class="btn btn-secondary">
                        <i class="fa fa-download me-2"></i>
                        {{ trans('cms::app.download') }}
                    </a>

                    <a href="javascript:void(0)"
                       class="btn btn-danger delete-file"
                       data-id="{id}"
                       data-is_file="{is_file}"
                       data-name="{name}">
                        <i class="fa fa-trash me-2"></i>
                        {{ trans('cms::app.delete') }}
                    </a>
                </div>

                <form action="{{ str_replace('__ID__', '{id}', route('admin.media.update', ['__ID__'])) }}"
                      method="post"
                      class="form-ajax">
                    @method('put')
                    <input type="hidden" name="is_file" value="{is_file}">

                    <div class="file-details">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ trans('cms::app.name') }}</label>
                            <input type="text" class="form-control" name="name" value="{name}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ trans('cms::app.url') }}</label>
                            <input type="text" class="form-control" value="{url}" readonly>
                        </div>

                        <table class="table table-details">
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
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        <i class="fa fa-save me-2"></i>
                        {{ trans('cms::app.save') }}
                    </button>
                </form>
            </div>
        </div>
    </template>

    @include('cms::backend.media.components.add_modal')
    @include('cms::backend.media.components.upload_modal')
@endsection

@section('footer')
    <script src="{{ asset('jw-styles/base/assets/js/media-manager.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function () {
            // Handle file selection
            $('.media-file-item').on('click', function() {
                const info = JSON.parse($(this).find('.item-info').val());
                const template = $('#media-detail-template').html();
                const content = replace_template(template, info);
                
                $('#preview-file')
                    .html(content)
                    .addClass('has-preview');
                
                // Highlight selected item
                $('.media-file-item').removeClass('selected');
                $(this).addClass('selected');
            });

            // Handle view switching
            $('.view-switcher .btn').on('click', function() {
                const view = $(this).data('view');
                $('.view-switcher .btn').removeClass('active');
                $(this).addClass('active');
                $('.media-list').removeClass('grid-view list-view').addClass(view + '-view');
            });

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
                            window.location.reload();
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
        });

        function add_folder_success(form) {
            window.location.reload();
        }
    </script>
@endsection
