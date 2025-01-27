<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('template_title')</title>

    <link href="{{ asset('jw-styles/mojar/installer/css/style.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('jw-styles/base/assets/css/tabler.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('jw-styles/base/assets/css/tabler-vendors.min.css') }}" rel="stylesheet" /> --}}

    <script>
        window.Laravel = @json([
            'csrfToken' => csrf_token(),
        ])
    </script>

    @yield('style')
</head>

<body>
    <div class="container">
        <h1>Application Setup Wizard</h1>
        <ul class="stepper">
            <li class="step {{ is_active_route('installer.welcome') }}">
                <div class="step-icon">1</div>
                <div class="step-label">
                    @if (Request::is('install') ||
                            Request::is('install/requirements') ||
                            Request::is('install/permissions') ||
                            Request::is('install/environment') ||
                            Request::is('install/environment/wizard') ||
                            Request::is('install/environment/classic'))
                        <a href="{{ route('installer.welcome') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Welcome</span>
                        </a>
                    @else
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Welcome</span>
                    @endif
                </div>
            </li>
            <li class="step {{ is_active_route('installer.requirements') }}">
                <div class="step-icon">2</div>
                <div class="step-label">
                    @if (Request::is('install') ||
                            Request::is('install/requirements') ||
                            Request::is('install/permissions') ||
                            Request::is('install/environment') ||
                            Request::is('install/environment/wizard') ||
                            Request::is('install/environment/classic'))
                        <a href="{{ route('installer.requirements') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Requirements</span>
                        </a>
                    @else
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Requirements</span>
                    @endif
                </div>
            </li>
            <li class="step {{ is_active_route('installer.permissions') }}">
                <div class="step-icon">4</div>
                <div class="step-label">
                    @if (Request::is('install/requirements') ||
                            Request::is('install/environment') ||
                            Request::is('install/environment/wizard') ||
                            Request::is('install/environment/classic'))
                        <a href="{{ route('installer.permissions') }}">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <span>Permissions</span>
                        </a>
                    @else
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <span>Permissions</span>
                    @endif
                </div>
            </li>
            <li class="step {{ is_active_route('installer.environment') }}">
                <div class="step-icon">3</div>
                <div class="step-label">
                    @if (Request::is('permissions') ||
                            Request::is('install/requirements') ||
                            Request::is('install/permissions') ||
                            Request::is('install/environment') ||
                            Request::is('install/environment/wizard') ||
                            Request::is('install/environment/classic'))
                        <a href="{{ route('installer.environment') }}">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span>Environment</span>
                        </a>
                    @else
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Environment</span>
                    @endif
                </div>
            </li>
            <li class="step {{ is_active_route('installer.admin') }}">
                <div class="step-icon">5</div>
                <div class="step-label">
                    @if (Request::is('install/theme'))
                        <a href="{{ route('installer.account') }}">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span>Account</span>
                        </a>
                    @else
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span>Account</span>
                    @endif
                </div>
            </li>

            <li class="step {{ is_active_route('installer.final') }}">
                <div class="step-icon">7</div>
                <div class="step-label">
                    <i class="fa fa-server" aria-hidden="true"></i>
                    <span>Complete</span>
                </div>
            </li>


        </ul>
        @yield('container')
    </div>

    {{-- <script src="{{ asset('jw-styles/mojar/installer/js/main.js') }}"></script> --}}
</body>
</html>
