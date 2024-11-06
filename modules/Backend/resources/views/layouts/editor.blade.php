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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,400i,700&display=swap">

    @include('cms::components.mojar_langs')

    @do_action('mojar_header')

    @yield('header')
</head>

<body class="mojar__menuLeft--dark mojar__topbar--fixed mojar__menuLeft--unfixed">
    <div class="mojar__layout">
        @php
            if (!isset($action)) {
                $currentUrl = url()->current();
                if (isset($model)) {
                    $action = $model->id
                        ? str_replace('/edit', '', $currentUrl)
                        : str_replace('/create', '', $currentUrl);
                } else {
                    $action = '';
                }
            }

            if (!isset($method)) {
                if (isset($model)) {
                    $method = $model->id ? 'put' : 'post';
                } else {
                    $method = 'post';
                }
            }
        @endphp

        <form action="{{ $action }}" method="post" class="form-ajax">
            @csrf

            @if ($method == 'put')
                @method('PUT')
            @endif

            <div class="mojar__layout">
                <div class="mojar__layout__header">
                    <div class="mojar__topbar">
                        <div>
                            <a href="{{ $linkIndex }}" class="mr-2">
                                <i class="fa fa-chevron-left fa-3x"></i>
                            </a>
                        </div>

                        <img src="{{ asset('jw-styles/mojar/images/icon.png') }}" alt="Logo Mojar">

                        <div class="mojar__btn-top">
                            @yield('buttons')
                        </div>
                    </div>
                </div>

                <div class="mojar__layout__content">
                    <div class="mojar__utils__content pt-3">
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

        </form>
    </div>

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
