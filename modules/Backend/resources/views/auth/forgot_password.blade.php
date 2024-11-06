@extends('cms::layouts.auth')

@section('content')
    <div class="mojar__layout__content">
        <div class="mojar__utils__content">
            <div class="mojar__auth__authContainer">
                <div class="mojar__auth__containerInner">
                    <div class="text-center mb-5">
                        @if ($logo = get_config('logo'))
                            <img src="{{ upload_url(get_config('logo')) }}" alt="{{ get_config('title', 'JUZAWEB') }}">
                        @else
                            <h1 class="mb-5 px-3">
                                <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'JUZAWEB')]) }}</strong>
                            </h1>
                        @endif
                    </div>

                    <div class="card mojar__auth__boxContainer">
                        <div class="text-dark font-size-24 mb-4">
                            <strong>{{ trans('cms::app.forgot_password') }}</strong>
                        </div>

                        <form action="{{ route('admin.forgot_password') }}" method="post" class="mb-4 form-ajax">
                            <div class="form-group mb-4">
                                <input type="text" name="email" class="form-control"
                                    placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" />
                            </div>

                            <button type="submit" class="btn btn-primary text-center w-100"
                                data-loading-text="{{ trans('cms::app.please_wait') }}">
                                <i class="fa fa-refresh"></i> {{ trans('cms::app.forgot_password') }}
                            </button>
                        </form>
                    </div>
                    <div class="text-center pt-2 mb-auto">
                        <span class="mr-2">{{ __('Already have an account?') }}</span>
                        <a href="{{ route('admin.login') }}" class="jw__utils__link font-size-16" data-turbolinks="false">
                            {{ trans('cms::app.login') }}
                        </a>
                    </div>
                </div>
                <div class="mt-auto pb-5 pt-5">
                    <div class="text-center">
                        Copyright © {{ date('Y') }} {{ get_config('title') }} - Provided by Mojar
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
