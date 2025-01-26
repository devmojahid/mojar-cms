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
                                <img src="{{ upload_url(get_config('logo')) }}" height="36" alt="{{ get_config('title', 'Mojar') }}">
                            @else
                                <h1 class="mb-5 px-3">
                                    <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'Mojar')]) }}</strong>
                                </h1>
                            @endif
                        </a>
                    </div>
                    <div class="card card-md">
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">{{ __('Create your account') }}</h2>
                            <form action="{{ route('register') }}" method="post" class="form-ajax">
                                @do_action('register_form')
                                
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('cms::app.full_name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ trans('cms::app.full_name') }}" autocomplete="off" required />
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                                    <input type="email" name="email" class="form-control" placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" required />
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('cms::app.password') }}</label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="password" class="form-control" placeholder="{{ trans('cms::app.password') }}" autocomplete="off" required />
                                        <span class="input-group-text">
                                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('cms::app.password_confirmation') }}</label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('cms::app.password_confirmation') }}" autocomplete="off" required />
                                        <span class="input-group-text">
                                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100" data-loading-text="{{ trans('cms::app.please_wait') }}">
                                        <strong>{{ __('Sign Up') }}</strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        @if(!empty($socialites))
                        <div class="hr-text">{{ __('or') }}</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($socialites as $key => $social)
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
                    <div class="text-center text-secondary mt-3">
                        {{ __('Already have an account?') }} <a href="{{ route('admin.login') }}" class="text-decoration-none">{{ __('Sign in') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg d-none d-lg-block">
                <img src="{{ asset('static/illustrations/undraw_secure_login_pdn4.svg') }}" height="300" class="d-block mx-auto" alt="">
            </div>
        </div>
    </div>

    @elseif (get_config('auth_layout') == 'with_cover')
    <div class="row g-0 flex-fill">
        <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px-lg-5">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                        @if ($logo = get_config('logo'))
                            <img src="{{ upload_url(get_config('logo')) }}" height="36" alt="{{ get_config('title', 'Mojar') }}">
                        @else
                            <h1 class="mb-5 px-3">
                                <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'Mojar')]) }}</strong>
                            </h1>
                        @endif
                    </a>
                </div>
                <h2 class="h3 text-center mb-3">{{ __('Create your account') }}</h2>
                <form action="{{ route('register') }}" method="post" class="form-ajax">
                    @do_action('register_form')
                    
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.full_name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('cms::app.full_name') }}" autocomplete="off" required />
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" required />
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.password') }}</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('cms::app.password') }}" autocomplete="off" required />
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                </a>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.password_confirmation') }}</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('cms::app.password_confirmation') }}" autocomplete="off" required />
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                </a>
                            </span>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100" data-loading-text="{{ trans('cms::app.please_wait') }}">
                            <strong>{{ __('Sign Up') }}</strong>
                        </button>
                    </div>
                </form>
                <div class="text-center text-secondary mt-3">
                    {{ __('Already have an account?') }} <a href="{{ route('admin.login') }}" class="text-decoration-none">{{ __('Sign in') }}</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
            <div class="bg-cover h-100 min-vh-100" style="background-image: url({{ asset('static/photos/finances-us-dollars-and-bitcoins-currency-money-2.jpg') }})"></div>
        </div>
    </div>

    @else
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                @if ($logo = get_config('logo'))
                    <img src="{{ upload_url(get_config('logo')) }}" height="36" alt="{{ get_config('title', 'Mojar') }}">
                @else
                    <h1 class="mb-5 px-3">
                        <strong>{{ trans('cms::message.login_form.welcome', ['name' => get_config('title', 'Mojar')]) }}</strong>
                    </h1>
                @endif
              </a>
            </div>
            <div class="card card-md">
              <div class="card-body">
                <h2 class="h2 text-center mb-4">{{ __('Create your account') }}</h2>
                <form action="{{ route('register') }}" method="post" class="form-ajax">
                    @do_action('register_form')
                    
                  <div class="mb-3">
                    <label class="form-label">{{ trans('cms::app.full_name') }}</label>
                    <input type="text" name="name" class="form-control" placeholder="{{ trans('cms::app.full_name') }}" autocomplete="off" required />
                  </div>
                    
                  <div class="mb-3">
                    <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                    <input type="email" name="email" class="form-control" placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" required />
                  </div>
                    
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.password') }}</label>
                    <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('cms::app.password') }}" autocomplete="off" required />
                      <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                      </span>
                    </div>
                  </div>
                    
                  <div class="mb-3">
                    <label class="form-label">{{ trans('cms::app.password_confirmation') }}</label>
                    <div class="input-group input-group-flat">
                      <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('cms::app.password_confirmation') }}" autocomplete="off" required />
                      <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                      </span>
                    </div>
                  </div>

                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100" data-loading-text="{{ trans('cms::app.please_wait') }}">
                        <strong>{{ __('Sign Up') }}</strong>
                    </button>
                  </div>
                </form>
              </div>
            
            @if(!empty($socialites))
            <div class="hr-text">{{ __('or') }}</div>
              <div class="card-body">
                <div class="row">
                    @foreach($socialites as $key => $social)
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
        <div class="text-center text-secondary mt-3">
            {{ __('Already have an account?') }} <a href="{{ route('admin.login') }}" class="text-decoration-none">{{ __('Sign in') }}</a>
        </div>
    </div>
    @endif
</div>
@endsection