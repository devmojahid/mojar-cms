@extends('cms::layouts.auth')

@section('content')
    <div class="page page-center">
        @if (get_config('auth_layout') == 'with_illustration')
            <div class="container container-normal py-4">
                <div class="row align-items-center g-4">
                    <div class="col-lg">
                        <div class="container-tight">
                            <div class="text-center mb-4">
                                <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                                    @if ($logo = get_config('logo'))
                                        <img src="{{ upload_url(get_config('logo')) }}" height="36"
                                            alt="{{ get_config('title', 'JUZAWEB') }}">
                                    @else
                                        <h1 class="mb-5 px-3">
                                            <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'JUZAWEB')]) }}</strong>
                                        </h1>
                                    @endif
                                </a>
                            </div>
                            <div class="card card-md">
                                <div class="card-body">
                                    <h2 class="h2 text-center mb-4">{{ trans('cms::message.login_form.header') }}</h2>
                                    <p class="text-center text-secondary mb-4">
                                        {{ trans('cms::message.login_form.description') }}
                                    </p>
                                    <form action="" method="post" class="form-ajax">
                                        @do_action('login_form')

                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="{{ trans('cms::app.email_address') }}" required />
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">
                                                {{ trans('cms::app.password') }}
                                                <span class="form-label-description">
                                                    <a href="{{ route('admin.forgot_password') }}"
                                                        class="text-decoration-none">
                                                        {{ trans('cms::app.forgot_password') }}
                                                    </a>
                                                </span>
                                            </label>
                                            <div class="input-group input-group-flat">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="{{ trans('cms::app.password') }}" required />
                                                <span class="input-group-text">
                                                    <a href="#" class="link-secondary password-toggle-button" title="Show password"
                                                        data-bs-toggle="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-check">
                                                <input type="checkbox" name="remember" value="1" checked
                                                    class="form-check-input" />
                                                <span class="form-check-label">{{ trans('cms::app.remember_me') }}</span>
                                            </label>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary w-100"
                                                data-loading-text="{{ trans('cms::app.please_wait') }}">
                                                <i class="fa fa-sign-in me-2"></i>{{ trans('cms::app.login') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                @if (!empty($socialites))
                                    <div class="hr-text">{{ __('or') }}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($socialites as $key => $social)
                                                @continue(($social['enable'] ?? 0) != 1)
                                                <div class="col">
                                                    <a href="{{ url("auth/{$key}/redirect") }}" class="btn w-100">
                                                        <i class="fa fa-{{ $key }} me-2"></i>
                                                        {{ trans('cms::app.socials.login_with', ['name' => ucfirst($key)]) }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if (get_config('user_registration'))
                                <div class="text-center text-secondary mt-3">
                                    {{ trans('cms::message.login_form.dont_have_an_account') }}
                                    <a href="{{ route('admin.register') }}"
                                        class="text-decoration-none">{{ __('Sign Up') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg d-none d-lg-block">
                        <img src="{{ asset('static/illustrations/undraw_secure_login_pdn4.svg') }}" height="300"
                            class="d-block mx-auto" alt="">
                    </div>
                </div>
            </div>
        @elseif (get_config('auth_layout') == 'with_cover')
            <div class="row g-0 flex-fill">
                <div
                    class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
                    <div class="container container-tight my-5 px-lg-5">
                        <div class="text-center mb-4">
                            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                                @if ($logo = get_config('logo'))
                                    <img src="{{ upload_url(get_config('logo')) }}" height="36"
                                        alt="{{ get_config('title', 'JUZAWEB') }}">
                                @else
                                    <h1 class="mb-5 px-3">
                                        <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'JUZAWEB')]) }}</strong>
                                    </h1>
                                @endif
                            </a>
                        </div>
                        <h2 class="h3 text-center mb-3">{{ trans('cms::message.login_form.header') }}</h2>
                        <p class="text-center text-secondary mb-4">
                            {{ trans('cms::message.login_form.description') }}
                        </p>
                        <form action="" method="post" class="form-ajax">
                            @do_action('login_form')

                            <div class="mb-3">
                                <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ trans('cms::app.email_address') }}" required />
                            </div>

                            <div class="mb-2">
                                <label class="form-label">
                                    {{ trans('cms::app.password') }}
                                    <span class="form-label-description">
                                        <a href="{{ route('admin.forgot_password') }}" class="text-decoration-none">
                                            {{ trans('cms::app.forgot_password') }}
                                        </a>
                                    </span>
                                </label>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ trans('cms::app.password') }}" required />
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary password-toggle-button" title="Show password"
                                            data-bs-toggle="tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-check">
                                    <input type="checkbox" name="remember" value="1" checked
                                        class="form-check-input" />
                                    <span class="form-check-label">{{ trans('cms::app.remember_me') }}</span>
                                </label>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100"
                                    data-loading-text="{{ trans('cms::app.please_wait') }}">
                                    <i class="fa fa-sign-in me-2"></i>{{ trans('cms::app.login') }}
                                </button>
                            </div>
                        </form>
                        @if (get_config('user_registration'))
                            <div class="text-center text-secondary mt-3">
                                {{ trans('cms::message.login_form.dont_have_an_account') }}
                                <a href="{{ route('admin.register') }}"
                                    class="text-decoration-none">{{ __('Sign Up') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
                    <div class="bg-cover h-100 min-vh-100"
                        style="background-image: url({{ asset('static/photos/finances-us-dollars-and-bitcoins-currency-money-2.jpg') }})">
                    </div>
                </div>
            </div>
        @else
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                        @if ($logo = get_config('logo'))
                            <img src="{{ upload_url(get_config('logo')) }}" height="36"
                                alt="{{ get_config('title', 'JUZAWEB') }}">
                        @else
                            <h1 class="mb-5 px-3">
                                <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'JUZAWEB')]) }}</strong>
                            </h1>
                        @endif
                    </a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">{{ trans('cms::message.login_form.header') }}</h2>
                        <p class="text-center text-secondary mb-4">
                            {{ trans('cms::message.login_form.description') }}
                        </p>
                        <form action="" method="post" class="form-ajax">
                            @do_action('login_form')

                            <div class="mb-3">
                                <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ trans('cms::app.email_address') }}" required />
                            </div>

                            <div class="mb-2">
                                <label class="form-label">
                                    {{ trans('cms::app.password') }}
                                    <span class="form-label-description">
                                        <a href="{{ route('admin.forgot_password') }}" class="text-decoration-none">
                                            {{ trans('cms::app.forgot_password') }}
                                        </a>
                                    </span>
                                </label>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ trans('cms::app.password') }}" required />
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary password-toggle-button" title="Show password"
                                            data-bs-toggle="tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-check">
                                    <input type="checkbox" name="remember" value="1" checked
                                        class="form-check-input" />
                                    <span class="form-check-label">{{ trans('cms::app.remember_me') }}</span>
                                </label>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100"
                                    data-loading-text="{{ trans('cms::app.please_wait') }}">
                                    <i class="fa fa-sign-in me-2"></i>{{ trans('cms::app.login') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    @if (!empty($socialites))
                        <div class="hr-text">{{ __('or') }}</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($socialites as $key => $social)
                                    @continue(($social['enable'] ?? 0) != 1)
                                    <div class="col">
                                        <a href="{{ url("auth/{$key}/redirect") }}" class="btn w-100">
                                            <i class="fa fa-{{ $key }} me-2"></i>
                                            {{ trans('cms::app.socials.login_with', ['name' => ucfirst($key)]) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @if (get_config('user_registration'))
                    <div class="text-center text-secondary mt-3">
                        {{ trans('cms::message.login_form.dont_have_an_account') }}
                        <a href="{{ route('admin.register') }}" class="text-decoration-none">{{ __('Sign Up') }}</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showPasswordButton = document.querySelector('.password-toggle-button');
            const passwordInput = document.querySelector('input[name="password"]');
            if (showPasswordButton && passwordInput) {
                showPasswordButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const type = passwordInput.getAttribute('type');
                    const isPassword = type === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    const svg = this.querySelector('svg');
                    if (svg) {
                        if (isPassword) {
                            svg.innerHTML =
                                `<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" />`;
                        } else {
                            svg.innerHTML =
                                `<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />`;
                        }
                    }
                });
            }
        });
    </script>
@endpush
