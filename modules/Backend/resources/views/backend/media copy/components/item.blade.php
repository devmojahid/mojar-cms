<div class="media-item {{ $item->type }}-item" 
     data-id="{{ $item->id }}"
     data-type="{{ $item->type }}"
     data-name="{{ $item->name }}">
    <div class="item-wrapper">
        <div class="item-preview">
            {{-- @if($item->isFolder()) --}}
                <a href="{{ route('admin.media.folder', [$item->id]) }}" class="folder-preview">
                    <div class="folder-icon">
                        <i class="fa fa-folder-o"></i>
                        <span class="item-count">{{ $item->children_count ?? 0 }}</span>
                    </div>
                    <div class="folder-overlay">
                        <div class="folder-actions">
                            <button type="button" class="btn btn-icon btn-rename" title="{{ trans('cms::app.rename') }}">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-delete" title="{{ trans('cms::app.delete') }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </a>
            {{-- @else --}}
                <div class="file-preview">
                    @if($item->type === 'image')
                        <img src="{{ $item->thumbnail }}" 
                             alt="{{ $item->name }}" 
                             loading="lazy"
                             class="preview-image">
                    @elseif($item->type === 'video')
                        <div class="video-preview">
                            <i class="fa fa-play-circle-o"></i>
                            <span class="duration">{{ $item->getDuration() }}</span>
                        </div>
                    @elseif($item->type === 'audio')
                        <div class="audio-preview">
                            <i class="fa fa-music"></i>
                            <span class="duration">{{ $item->getDuration() }}</span>
                        </div>
                    @else
                        <div class="document-preview">
                            {{-- <i class="fa {{ $item->getFileIcon() }}"></i> --}}
                            <span class="extension">{{ strtoupper($item->extension) }}</span>
                        </div>
                    @endif
                    
                    <div class="item-overlay">
                        <div class="item-actions">
                            <button type="button" class="btn btn-icon btn-preview" title="{{ trans('cms::app.preview') }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-download" 
                                    title="{{ trans('cms::app.download') }}"
                                    {{-- data-url="{{ $item->getDownloadUrl() }}" --}}
                                    >
                                <i class="fa fa-download"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-delete" title="{{ trans('cms::app.delete') }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
        </div>

        <div class="item-info">
            <div class="item-name" title="{{ $item->name }}">
                {{ $item->name }}
            </div>
            <div class="item-meta">
                <span class="item-size" title="{{ trans('cms::app.size') }}">
                    <i class="fa fa-hdd-o"></i>
                    {{-- {{ $item->getFormattedSize() }} --}}
                </span>
                <span class="item-date" title="{{ trans('cms::app.last_modified') }}">
                    <i class="fa fa-clock-o"></i>
                    {{ $item->updated_at->diffForHumans() }}
                </span>
            </div>
        </div>

        <div class="item-select">
            <div class="form-check">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="select-{{ $item->id }}"
                       data-id="{{ $item->id }}">
                <label class="form-check-label" for="select-{{ $item->id }}"></label>
            </div>
        </div>
    </div>
</div>
