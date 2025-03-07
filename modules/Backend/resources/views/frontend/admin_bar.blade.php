<link rel="stylesheet" href="{{ asset('jw-styles/mojar/css/admin-bar.css') }}">
<script src="{{ asset('jw-styles/mojar/js/admin-bar.js') }}"></script>

@php
    $speedDialItems = [
        [
            'label' => 'Dashboard',
            'icon'  => 'M3 13l9 9l9-9 M9 17V9h6v8 M5 13l7-7 7 7',
            'url'   => admin_url(),
        ],
        [
            'label' => 'New Post',
            'icon'  => 'M12 20h9 M12 4h9 M4 9h16 M4 15h16',
            'url'   => admin_url('post-type/posts/create'),
        ],
        [
            'label' => 'New Page',
            'icon'  => 'M21 15V5a2 2 0 0 0-2-2H7l5 5h7a2 2 0 0 1 2 2v5 M18 21H4a2 2 0 0 1-2-2V7 M8 21v-4a4 4 0 0 1 4-4h4',
            'url'   => admin_url('post-type/pages/create'),
        ],
        [
            'label' => 'New User',
            'icon'  => 'M17 21v-2a4 4 0 0 0-4-4H5 A4 4 0 0 0 1 19v2 M9 7a4 4 0 0 1 0 8 M23 21v-2a4 4 0 0 0-3-3.85',
            'url'   => admin_url('users/create'),
        ],
    ];
@endphp


<div id="jwSpeedDial" class="jw-speed-dial" draggable="true">
    <button id="jwSpeedDialToggle" class="jw-speed-dial-toggle" aria-label="Toggle Speed Dial" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </button>

    <ul id="jwSpeedDialActions" class="jw-speed-dial-actions" aria-hidden="true">
        @foreach($speedDialItems as $item)
        <li class="jw-speed-dial-item" data-item-id="{{ $loop->index }}" tabindex="0">
            <a href="{{ $item['url'] }}" class="jw-speed-dial-link" data-turbolinks="false">
                <div class="jw-speed-dial-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="{{ $item['icon'] }}"></path>
                    </svg>
                </div>
                <span class="jw-speed-dial-label">{{ $item['label'] }}</span>
            </a>
            <button class="jw-close-item" aria-label="Remove {{ $item['label'] }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </li>
        @endforeach
    </ul>
</div>
