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

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/mojar/css/vendor.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/mojar/css/backend.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/mojar/css/custom.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('jw-styles/base/assets/css/tabler.min.css') }}">

    @include('cms::components.mojar_langs')

    <script src="{{ asset('jw-styles/mojar/js/vendor.min.js') }}"></script>
    <script src="{{ asset('jw-styles/mojar/js/custom-main.min.js') }}"></script>
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
        <div class="mojar__layout">
            <div id="jquery-message"></div>

            @yield('content')

            @if (get_config('captcha'))
                <div id="recaptcha-render" style="display: none;"></div>
            @endif
        </div>
    </div>
</body>

</html>
