<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('jw-styles/mojar/images/favicon.ico') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />

    <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/mojar/css/backend.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/mojar/assets/css/tabler.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/mojar/assets/css/tabler-vendors.css') }}">

    <style>
        .alert-icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .alert-success .alert-icon-wrapper {
            background-color: rgba(47, 179, 68, 0.1);
            color: #2fb344;
        }

        .alert-danger .alert-icon-wrapper {
            background-color: rgba(214, 57, 57, 0.1);
            color: #d63939;
        }

        .alert-warning .alert-icon-wrapper {
            background-color: rgba(245, 159, 0, 0.1);
            color: #f59f00;
        }

        .alert-info .alert-icon-wrapper {
            background-color: rgba(66, 153, 225, 0.1);
            color: #4299e1;
        }

        .alert-content {
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .btn-close {
            opacity: 0.5;
            transition: opacity 0.2s;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .jw-message {
            animation: slideIn 0.3s ease-out forwards;
            color: #fff;
        }
    </style>

    @include('cms::components.mojar_langs')

    <script src="{{ asset('jw-styles/mojar/js/vendor.min.js') }}"></script>
    <script src="{{ asset('jw-styles/mojar/js/backend.min.js') }}"></script>

    @if (get_config('captcha'))
        <script>
            const recaptchaSiteKey = "{{ get_config('google_captcha.site_key') }}";
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=recaptchaLoadCallback&render=explicit" async defer></script>
    @endif

    <script src="{{ asset('jw-styles/mojar/js/custom.min.js') }}"></script>
    <script src="{{ asset('jw-styles/mojar/js/custom-main.min.js') }}"></script>

    @yield('header')

</head>

<body class="mojar__layout--cardsShadow mojar__menuLeft--dark">
    <div class="mojar__layout mojar__layout--hasSider">
        <div class="mojar__menuLeft__backdrop"></div>
        <div class="mojar__layout authLayut">
            <div id="jquery-message"></div>

            @yield('content')

            @if (get_config('captcha'))
                <div id="recaptcha-render" style="display: none;"></div>
            @endif
        </div>
    </div>

    @stack('scripts')
</body>

</html>
