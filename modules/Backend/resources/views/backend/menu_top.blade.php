<div class="container-fluid">
    @php
        global $jw_user;
    @endphp
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
        aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <h1 class="navbar-brand navbar-brand-autodark">
        <a href="/{{ config('mojar.admin_prefix') }}">
            @if ($logo = get_config('admin_logo'))
                <img src="{{ upload_url(get_config('admin_logo')) }}" alt="{{ get_config('title', 'Mojar') }}">
            @else
                <img src="{{ asset('jw-styles/base/assets/static/logo.svg') }}" width="110" height="32"
                    alt="Tabler" class="navbar-brand-image">
                {{-- {{ trans('cms::message.admin_logo', ['name' => get_config('title', 'Mojar')]) }} --}}
            @endif
        </a>
    </h1>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
        aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav flex-row order-md-last">
        <div class="d-flex align-items-center me-3">
            <form action="javascript:void(0);" method="get" autocomplete="off" class="navbar-search-form">
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Search…"
                        aria-label="Search in website" id="topbarSearchInput">
                </div>
            </form>
        </div>
        <div class="d-flex align-items-center me-3">
            <a class="btn" type="button" href="{{ url('/') }}" target="_blank">
                <svg class="icon icon-left svg-icon-ti-ti-world" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                    <path d="M3.6 9h16.8"></path>
                    <path d="M3.6 15h16.8"></path>
                    <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                    <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                </svg>
                {{ trans('cms::app.view_site') }}
            </a>
        </div>
        <div class="dropdown me-3 d-none d-md-flex align-items-center">
            @php
                $langs = \Illuminate\Support\Facades\Cache::remember('top_menu_languages', 3600, function () {
                    return app(\Juzaweb\CMS\Support\Manager\TranslationManager::class)
                        ->locale('cms')
                        ->languages();
                });
                $current = $jw_user->language ?? get_config('language', 'en');
            @endphp
            <a href="javascript:void(0)" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-language">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 5h7" />
                    <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                    <path d="M5 9c0 2.144 2.952 3.908 6.7 4" />
                    <path d="M12 20l4 -9l4 9" />
                    <path d="M19.1 18h-6.2" />
                </svg>
                {{ $current }}
            </a>
            <div class="dropdown-menu">
                @foreach ($langs as $lang)
                    @if ($current == $lang['code'])
                        @continue
                    @endif

                    <a class="dropdown-item" href="{{ url()->current() }}?hl={{ $lang['code'] }}">
                        <span class="text-uppercase font-size-12 mr-1">{{ $lang['code'] }}</span>
                        {{ $lang['name'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="dropdown me-3 d-none d-md-flex align-items-center">
            <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M18 13l-6 6" />
                    <path d="M6 13l6 6" />
                </svg>
                {{ trans('cms::app.new') }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item"
                    href="{{ route('admin.posts.create', ['posts']) }}">{{ trans('cms::app.post') }}</a>
                <a class="dropdown-item"
                    href="{{ route('admin.posts.create', ['pages']) }}">{{ trans('cms::app.page') }}</a>
                <a class="dropdown-item" href="{{ route('admin.users.create') }}">{{ trans('cms::app.user') }}</a>
            </div>
        </div>

        <div class="d-none d-md-flex">
            <a href="javascript:void(0)" class="nav-link px-0 hide-theme-dark " title="Enable dark mode"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-theme="dark" data-bs-theme-value="dark">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                </svg>
            </a>
            <a href="javascript:void(0)" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-theme="light"
                data-bs-theme-value="light">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path
                        d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                </svg>
            </a>
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                    aria-label="Show notifications">
                    <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                    @php
                        $total = count_unread_notifications();
                        $items = Auth::user()
                            ->unreadNotifications()
                            ->cacheFor(3600)
                            ->orderBy('id', 'DESC')
                            ->limit(5)
                            ->get(['id', 'data', 'created_at']);
                    @endphp
                    @if ($total > 0)
                        <span class="badge bg-red">{{ $total }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('cms::app.notifications') }} ({{ $total }})</h3>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable">
                            @if ($items->isEmpty())
                                <div class="list-group-item">
                                    <div class="row align-items-center justify-content-center py-4">
                                        <div class="col-auto">
                                            <!-- Empty inbox icon from tabler -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-lg text-muted mb-3" width="40" height="40"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                <path d="M4 13h16" />
                                                <path d="M8 4l0 9" />
                                                <path d="M16 4l0 9" />
                                                <path d="M9 14l0 .01" />
                                                <path d="M12 14l0 .01" />
                                                <path d="M15 14l0 .01" />
                                            </svg>
                                        </div>
                                        <div class="col-12 text-center">
                                            <h3 class="text-muted mb-2">{{ trans('cms::app.no_notifications') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @foreach ($items as $notify)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span
                                                    class="status-dot status-dot-animated bg-red d-block"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="{{ route('admin.profile.notification', [$notify->id]) }}"
                                                    class="text-body d-block">
                                                    {{ $notify->data['subject'] ?? '' }}
                                                </a>
                                                <div class="text-muted">{{ $notify->created_at?->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="list-group-item-actions">

                                                    <div class="col text-truncate">
                                                        <a href="{{ route('admin.profile.notification', [$notify->id]) }}"
                                                            class="text-body d-block">
                                                            {{ $notify->data['subject'] ?? '' }}
                                                        </a>
                                                        <div class="text-muted">
                                                            {{ $notify->created_at?->diffForHumans() }}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon text-muted" width="24" height="24"
                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none" />
                                                                <path
                                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{ $jw_user->getAvatar() }})"></span>
                <div class="d-none d-xl-block ps-2">
                    <div>{{ $jw_user->name }}</div>
                    <div class="mt-1 small text-secondary">{{ $jw_user->email }}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{ route('admin.profile') }}" class="dropdown-item">{{ trans('cms::app.profile') }}</a>
                <a href="{{ url('app/setting/system') }}" class="dropdown-item">Settings</a>
                <a href="javascript:void(0)" class="dropdown-item auth-logout">{{ trans('cms::app.logout') }}</a>
            </div>
        </div>
    </div>
</div>
