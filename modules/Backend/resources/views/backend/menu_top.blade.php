<div class="container-xl">
    @php
        global $jw_user;
    @endphp
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav flex-row order-md-last">
        <div class="d-flex align-items-center me-3">
            <a class="btn" type="button" href="{{ url('/') }}" target="_blank">
                <svg class="icon icon-left svg-icon-ti-ti-world" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                $langs = \Illuminate\Support\Facades\Cache::remember(
                    'top_menu_languages',
                    3600,
                    function () {
                        return app(\Juzaweb\CMS\Support\Manager\TranslationManager::class)->locale('cms')
                            ->languages();
                    }
                );
                $current = $jw_user->language ?? get_config('language', 'en');
            @endphp
            <a href="javascript:void(0)" class="btn dropdown-toggle" data-bs-toggle="dropdown">{{ $current }}</a>
            <div class="dropdown-menu">
                @foreach($langs as $lang)
                    @if($current == $lang['code'])
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
            <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">{{ trans('cms::app.new') }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.posts.create', ['posts']) }}">{{ trans('cms::app.post') }}</a>
                <a class="dropdown-item" href="{{ route('admin.posts.create', ['pages']) }}">{{ trans('cms::app.page') }}</a>
                <a class="dropdown-item" href="{{ route('admin.users.create') }}">{{ trans('cms::app.user') }}</a>
            </div>
        </div>

        <div class="d-none d-md-flex">
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                data-bs-toggle="tooltip" data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                </svg>
            </a>
            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                data-bs-toggle="tooltip" data-bs-placement="bottom">
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
                            @if($items->isEmpty())
                                <p>{{ trans('cms::app.no_notifications') }}</p>
                            @else
                                @foreach($items as $notify)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span
                                                    class="status-dot status-dot-animated bg-red d-block"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="{{ route('admin.profile.notification', [$notify->id]) }}" class="text-body d-block">
                                                    {{ $notify->data['subject'] ?? '' }}
                                                </a>
                                                <div class="text-muted">{{ $notify->created_at?->diffForHumans() }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="list-group-item-actions">
                                                    
                                            <div class="col text-truncate">
                                                <a href="{{ route('admin.profile.notification', [$notify->id]) }}" class="text-body d-block">
                                                    {{ $notify->data['subject'] ?? '' }}
                                                </a>
                                                <div class="text-muted">{{ $notify->created_at?->diffForHumans() }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="list-group-item-actions">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon text-muted" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
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
                <span class="avatar avatar-sm"
                    style="background-image: url({{ $jw_user->getAvatar() }})"></span>
                <div class="d-none d-xl-block ps-2">
                    <div>{{ $jw_user->name }}</div>
                    <div class="mt-1 small text-secondary">{{ $jw_user->email }}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{ route('admin.profile') }}" class="dropdown-item">{{ trans('cms::app.profile') }}</a>
                <a href="./settings.html" class="dropdown-item">Settings</a>    
                <a href="javascript:void(0)" class="dropdown-item auth-logout">{{ trans('cms::app.logout') }}</a>
            </div>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div>
            <form action="./" method="get" autocomplete="off" novalidate>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>
                    <input type="text" value="" class="form-control" placeholder="Search…"
                        aria-label="Search in website">
                </div>
            </form>
        </div>
    </div>
</div>

