<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }}</title>
    <link rel="icon" href="{{ asset('jw-styles/mojar/images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">


    @include('cms::components.mojar_langs')

    @do_action('mojar_header')

    @yield('header')

</head>

<body class="mojar__menuLeft--dark mojar__menuLeft--unfixed mojar__menuLeft--shadow" data-bs-theme="{{ session('theme') }}">
    <div id="admin-overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md sticky-top d-none d-lg-flex d-print-none mojar_cms_topbar" data-bs-theme="{{ session('theme') }}">
            @include('cms::backend.menu_top')
         </header>
        <!-- Sidebar -->
        <div class="d-block d-lg-flex">
            <aside class="navbar navbar-vertical navbar-expand-lg mojar_cms_sidebar" data-bs-theme="{{ session('theme') }}">
                <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="/{{ config('mojar.admin_prefix') }}" class="d-lg-none d-block">
                        @if ($logo = get_config('admin_logo'))
                            <img src="{{ upload_url(get_config('admin_logo')) }}"
                                alt="{{ get_config('title', 'Mojar') }}">
                        @else
                            <img src="{{ asset('jw-styles/base/assets/static/logo.svg') }}" width="110"
                                height="32" alt="Tabler" class="navbar-brand-image">
                            {{-- {{ trans('cms::message.admin_logo', ['name' => get_config('title', 'Mojar')]) }} --}}
                        @endif
                    </a>
                </h1>
                <div class="navbar-nav flex-row d-lg-none">
                    <div class="nav-item d-none d-lg-flex me-3">
                    </div>
                    <div class="d-none d-lg-flex">
                        <div class="nav-item dropdown d-none d-md-flex me-3">
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm"
                                style="background-image: url(./static/avatars/000m.jpg)"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>Paweł Kuna</div>
                                <div class="mt-1 small text-secondary">UI Designer</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Status</a>
                            <a href="./profile.html" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Feedback</a>
                            <div class="dropdown-divider"></div>
                            <a href="./settings.html" class="dropdown-item">Settings</a>
                            <a href="./sign-in.html" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    @include('cms::backend.menu_left')
                </div>
            </div>
        </aside>

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row align-items-center justify-content-between">
                        <div class="col">
                            @if (!request()->is(config('mojar.admin_prefix')))
                                {{ jw_breadcrumb('admin', [
                                    [
                                        'title' => $title,
                                    ],
                                ]) }}
                            @else
                                <div class="mb-3"></div>
                            @endif
                        </div>
                        @yield('breadcrumb-right')
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @do_action('backend_message')

                    @php
                        $messages = get_backend_message();
                    @endphp

                    @foreach ($messages as $message)
                        <div class="alert alert-{{ $message['status'] == 'error' ? 'danger' : $message['status'] }} alert-dismissible jw-message"
                            role="alert">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </div>
                                <div>
                                    {!! e_html($message['message']) !!}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"
                                data-id="{{ $message['id'] }}"></a>
                        </div>
                    @endforeach

                    @if (session()->has('message'))
                        <div
                            class="alert alert-{{ session()->get('status') == 'error' ? 'danger' : 'success' }} jw-message">
                            {{ session()->get('message') }}</div>
                    @endif

                    <div id="jquery-message"></div>

                    @yield('content')
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center justify-content-center">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2023
                                    <a href="" class="link-secondary">{{ get_config('title') }}</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="./changelog.html" class="link-secondary" rel="noopener">
                                        v1.0.0-beta20
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        </div>
    </div>

    @include('cms::components.custom-alert')
    <template id="form-images-template">
        @component('cms::components.image-item', [
            'name' => '{name}',
            'path' => '{path}',
            'url' => '{url}',
        ])
        @endcomponent
    </template>

    <form action="{{ route('logout') }}" method="post" style="display: none" class="form-logout">
        @csrf
    </form>

    <script type="text/javascript">
        $.extend($.validator.messages, {
            required: "{{ trans('cms::app.this_field_is_required') }}",
        });

        $(".form-ajax").validate();

        $(".auth-logout").on('click', function() {
            $('.form-logout').submit();
        });
    </script>

    @do_action('mojar_footer')

    @yield('footer')
</body>

</html>
