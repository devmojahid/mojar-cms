<li class="jw-media-item" title="{{ $item->name }}">
    <a
        href="{{ $item instanceof \Juzaweb\Backend\Models\MediaFolder ? route('admin.media.folder', [$item->id]) : 'javascript:void(0)' }}"
        class="jw-media-item-info @if ($item instanceof \Juzaweb\Backend\Models\MediaFile) media-file-item @endif"
        data-id="{{ $item->id }}"
    >
        @php
            $arr = $item->toArray();
            $arr['url'] = get_full_url(upload_url($item->path), url('/'));
            $arr['updated'] = jw_date_format($item->updated_at);
            $arr['size'] = format_size_units($item->size);
            $arr['is_file'] = $item instanceof \Juzaweb\Backend\Models\MediaFile ? 1 : 0;
        @endphp
        <textarea class="d-none item-info">@json($arr)</textarea>

        <div class="jw-attachment-preview">
            <div class="jw-thumbnail">
                <div class="jw-centered">
                    @if ($item instanceof \Juzaweb\Backend\Models\MediaFolder)
                        <img
                            src="{{ asset('jw-styles/mojar/images/folder.png') }}"
                            alt="{{ $item->name }}"
                            class="img-fluid"
                        >
                    @else
                    @if (in_array($item->type, ['image', 'jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img
                                class="lazyload img-fluid"
                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                data-src="{{ upload_url($item->path, null, '150x150') }}"
                                alt="{{ $item->name }}"
                            >
                        @else
                            <img
                                class="lazyload img-fluid"
                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                data-src="{{ asset('jw-styles/mojar/images/file.png') }}"
                                alt="{{ $item->name }}"
                            >
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="jw-media-name text-truncate mt-2">
            <span class="file-name">{{ $item->name }}</span>
        </div>
    </a>
</li>
