<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('template_title')</title>

    <link href="{{ asset('jw-styles/mojar/installer/css/style.css') }}" rel="stylesheet" />

    <script>
        window.Laravel = @json([
            'csrfToken' => csrf_token(),
        ])
    </script>

    <style>
        .error-block {
            color: red;
        }

        .error-block i {
            margin-right: 5px;
        }

        .error-block p {
            margin-bottom: 0;
        }

        .has-error {
            border: 1px solid red;
        }

        .rounded-full {
            border-radius: 50%;
        }

        .w-20 {
            width: 5rem;
        }

        .h-20 {
            height: 5rem;
        }

        .w-4 {
            width: 1rem;
        }

        .h-4 {
            height: 1rem;
        }

        .text-center{
            text-align: center;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }
        .justify-center {
            justify-content: center;
        }
        .items-center {
            align-items: center;
        }
        
        .gap-4 {
            gap: 1rem;
        }
        .pt-6 {
            padding-top: 1.5rem;
        }
        .text-muted {
            color: #6c757d;
        }
        
    </style>

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
