<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '' }}</title>
    <link rel="icon" href="{{ asset('jw-styles/mojar/images/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Mukta:400,700,800&display=swap" rel="stylesheet" />

    @php
        $version = \Mojar\CMS\Version::getVersion();
    @endphp

    <link rel="stylesheet" type="text/css"
        href="{{ asset('jw-styles/mojar/css/vendor.min.css') }}?v={{ $version }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('jw-styles/mojar/css/backend.min.css') }}?v={{ $version }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('jw-styles/mojar/css/custom.min.css') }}?v={{ $version }}">

    @include('cms::components.mojar_langs')

    <script src="{{ asset('jw-styles/mojar/js/vendor.min.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('jw-styles/mojar/js/backend.min.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('jw-styles/mojar/js/custom.min.js') }}?v={{ $version }}"></script>

    @yield('header')
</head>

<body class="mojar__menuLeft--dark mojar__topbar--fixed mojar__menuLeft--unfixed mojar__menuLeft--shadow">
    <div class="mojar__layout mojar__layout--hasSider">

        <div class="mojar__menuLeft">
            <div class="mojar__menuLeft__mobileTrigger"><span></span></div>

            <div class="mojar__menuLeft__outer">
                <div class="mojar__menuLeft__logo__container">
                    <a href="/{{ config('mojar.admin_prefix') }}/network">
                        <div class="mojar__menuLeft__logo">
                            <img src="{{ asset('jw-styles/mojar/images/logo.svg') }}" class="mr-1" alt="Mojar">
                            <div class="mojar__menuLeft__logo__name">JuzaWeb</div>
                            <div class="mojar__menuLeft__logo__descr">Cms</div>
                        </div>
                    </a>
                </div>

                <div class="mojar__menuLeft__scroll jw__customScroll">
                    @include('network::components.menu_left')
                </div>
            </div>
        </div>
        <div class="mojar__menuLeft__backdrop"></div>

        <div class="mojar__layout">
            <div class="mojar__layout__header">
                @include('network::components.menu_top')
            </div>

            <div class="mojar__layout__content">
                @if (!request()->is(config('mojar.admin_prefix') . '/network'))
                    {{ jw_breadcrumb('admin', [
                        [
                            'title' => $title,
                        ],
                    ]) }}
                @else
                    <div class="mb-3"></div>
                @endif

                @if ($version = cache()->store('file')->get(cache_prefix('check_cms_update')))
                    @if ($version != 1)
                        <div class="alert alert-warning w-50 ml-3">
                            <a href="https://mojar.com/documentation/changelog">JuzaCms {{ $version }}</a>
                            {{ __('is available!') }} <a
                                href="{{ route('admin.update') }}">{{ __('Please update now') }}</a>.
                        </div>
                    @endif
                @endif

                <h4 class="font-weight-bold ml-3 text-capitalize">{{ $title }}</h4>

                <div class="mojar__utils__content">

                    @do_action('backend_message')

                    @php
                        $messages = get_backend_message();
                    @endphp

                    @foreach ($messages as $message)
                        <div
                            class="alert alert-{{ $message['status'] == 'error' ? 'danger' : $message['status'] }} jw-message">
                            <button type="button" class="close close-message" data-dismiss="alert" aria-label="Close"
                                data-id="{{ $message['id'] }}">
                                <span aria-hidden="true">×</span>
                            </button>
                            {!! e_html($message['message']) !!}
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

            <div class="mojar__layout__footer">
                <div class="mojar__footer">
                    <div class="mojar__footer__inner">
                        <a href="https://mojar.com" target="_blank" rel="noopener noreferrer"
                            class="mojar__footer__logo">
                            Mojar - Build website professional
                            <span></span>
                        </a>
                        <br />
                        <p class="mb-0">
                            Copyright © {{ date('Y') }} {{ get_config('title') }} - Provided by Mojar
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="form-images-template">
        @component('cms::components.image-item', [
            'name' => '{name}',
            'path' => '{path}',
            'url' => '{url}',
        ])
        @endcomponent
    </template>

    <div id="show-modal"></div>

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

    @yield('footer')
</body>

</html>
