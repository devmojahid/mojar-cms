@extends('cms::installer.layouts.master')

@section('template_title')
    {{ trans('cms::installer.final.template_title') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('cms::installer.final.title') }}
@endsection

@section('container')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Create Admin Account</h2>
    </div>
    <div class="card-content">
        <div class="space-y-8">
            <div class="max-w-md mx-auto space-y-6">
                <div class="space-y-2">
                    <label for="full-name" class="text-sm font-medium">Full Name</label>
                    <input type="text" id="full-name" class="input" placeholder="John Doe">
                </div>
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium">Email Address</label>
                    <input type="email" id="email" class="input" placeholder="john@example.com">
                </div>
                <div class="space-y-2">
                    <label for="username" class="text-sm font-medium">Username</label>
                    <input type="text" id="username" class="input" placeholder="johndoe">
                </div>
                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium">Password</label>
                    <input type="password" id="password" class="input" placeholder="••••••••">
                </div>
                <div class="space-y-2">
                    <label for="confirm-password" class="text-sm font-medium">Confirm Password</label>
                    <input type="password" id="confirm-password" class="input" placeholder="••••••••">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="theme.html" class="button button-outline w-full sm:w-auto">Previous</a>
                <a href="license.html" class="button w-full sm:w-auto">Continue</a>
            </div>
        </div>
    </div>
</div>
    {{-- <form method="post" action="{{ route('installer.admin.save') }}" autocomplete="off">
        @csrf

        <div class="form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
            <label for="name">
                {{ trans('cms::installer.environment.wizard.form.name') }}
            </label>
            <input type="text" name="name" id="name" placeholder="{{ trans('cms::installer.environment.wizard.form.name') }}" autocomplete="off" required value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
            <label for="email">
                {{ trans('cms::installer.environment.wizard.form.email') }}
            </label>
            <input type="text" name="email" id="email" placeholder="{{ trans('cms::installer.environment.wizard.form.email') }}" autocomplete="off" required value="{{ old('email') }}" />
            @if ($errors->has('email'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error ' : '' }}">
            <label for="password">
                {{ trans('cms::installer.environment.wizard.form.password') }}
            </label>
            <input type="password" name="password" id="password" placeholder="{{ trans('cms::installer.environment.wizard.form.password') }}" autocomplete="off" required />
            @if ($errors->has('password'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
            <label for="password_confirmation">
                {{ trans('cms::installer.environment.wizard.form.password_confirmation') }}
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ trans('cms::installer.environment.wizard.form.password_confirmation') }}" autocomplete="off" required />
            @if ($errors->has('password_confirmation'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>

        <div class="buttons">
            <button type="submit" class="button btn-submit">
                {{ trans('cms::installer.environment.wizard.form.buttons.create_user_admin') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form> --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        $('form').on('submit', function () {
            $('.btn-submit')
                .html("{{ trans('cms::app.please_wait') }}")
                .prop('disabled', true);
        });
    </script>
@endsection
