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
            <h2 class="card-title">{{ trans('cms::installer.environment.wizard.form.create_admin_account') }}</h2>
        </div>
        <div class="card-content">
            <form method="post" action="{{ route('installer.admin.save') }}" autocomplete="off">
                @csrf
                <div class="space-y-8">
                    <div class="max-w-md mx-auto space-y-6">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium">
                                {{ trans('cms::installer.environment.wizard.form.name') }}
                            </label>
                            <input type="text" id="name" class="input {{ $errors->has('name') ? ' has-error ' : '' }}" placeholder="{{ trans('cms::installer.environment.wizard.form.name') }}" autocomplete="off" required value="{{ old('name') }}" name="name">
                            @if ($errors->has('name'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium">
                                {{ trans('cms::installer.environment.wizard.form.email') }}
                            </label>
                            <input type="email" id="email" class="input {{ $errors->has('email') ? ' has-error ' : '' }}" placeholder="{{ trans('cms::installer.environment.wizard.form.email') }}" autocomplete="off" required value="{{ old('email') }}" name="email">
                            @if ($errors->has('email'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium">
                                {{ trans('cms::installer.environment.wizard.form.password') }}
                            </label>
                            <input type="password" id="password" class="input {{ $errors->has('password') ? ' has-error ' : '' }}" name="password" placeholder="{{ trans('cms::installer.environment.wizard.form.password') }}" autocomplete="off" required>
                            @if ($errors->has('password'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-medium">
                                {{ trans('cms::installer.environment.wizard.form.password_confirmation') }}
                            </label>
                            <input type="password" id="password_confirmation" class="input {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}" name="password_confirmation" placeholder="{{ trans('cms::installer.environment.wizard.form.password_confirmation') }}" autocomplete="off" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('password_confirmation') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="w-full sm:w-auto">
                          
                        </div>
                        <div class="buttons">
                            <button type="submit" class="button w-full sm:w-auto btn-submit">
                                {{ trans('cms::installer.environment.wizard.form.buttons.create_user_admin') }}
                                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('form').on('submit', function() {
            $('.btn-submit')
                .html("{{ trans('cms::app.please_wait') }}")
                .prop('disabled', true);
        });
    </script>
@endsection
