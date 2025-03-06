@extends('cms::installer.layouts.master')

@section('template_title')
    {{ trans('cms::installer.environment.wizard.template_title') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('cms::installer.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Environment Configuration</h2>
        </div>
        <div class="card-content">
            <form method="post" action="{{ route('installer.environment.save') }}" class="tabs-wrap" autocomplete="off">
                @csrf
                <div class="space-y-8">
                    <div class="grid gap-6">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="app-name" class="text-sm font-medium">{{ trans('cms::installer.environment.wizard.form.app_name_label') }}</label>
                                <input type="text" name="app_name" id="app-name" class="input {{ $errors->has('app_name') ? ' has-error ' : '' }}" placeholder="{{ trans('cms::installer.environment.wizard.form.app_name_placeholder') }}">
                                @if ($errors->has('app_name'))
                                    <span class="error-block">
                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                        {{ $errors->first('app_name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="space-y-2">
                                <label for="app-url" class="text-sm font-medium">{{ trans('cms::installer.environment.wizard.form.app_url_label') }}</label>
                                <input type="text" name="app_url" id="app-url" class="input {{ $errors->has('app_url') ? ' has-error ' : '' }}" placeholder="{{ trans('cms::installer.environment.wizard.form.app_url_placeholder') }}">
                                @if ($errors->has('app_url'))
                                    <span class="error-block">
                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                        {{ $errors->first('app_url') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Database Configuration</h3>
                            <div class="space-y-2">
                                <label for="database_connection" class="text-sm font-medium">
                                    {{ trans('cms::installer.environment.wizard.form.db_connection_label') }}
                                </label>
                                <select name="database_connection" id="database_connection" class="select">
                                    <option value="mysql" selected>
                                        {{ trans('cms::installer.environment.wizard.form.db_connection_label_mysql') }}
                                    </option>
                                    <option value="sqlite">
                                        {{ trans('cms::installer.environment.wizard.form.db_connection_label_sqlite') }}
                                    </option>
                                    <option value="pgsql">
                                        {{ trans('cms::installer.environment.wizard.form.db_connection_label_pgsql') }}
                                    </option>
                                    <option value="sqlsrv">
                                        {{ trans('cms::installer.environment.wizard.form.db_connection_label_sqlsrv') }}
                                    </option>
                                </select>

                                @if ($errors->has('database_connection'))
                                    <span class="error-block">
                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                        {{ $errors->first('database_connection') }}
                                    </span>
                                @endif
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="database_hostname" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.db_host_label') }}
                                    </label>
                                    <input type="text" name="database_hostname" id="database_hostname" class="input {{ $errors->has('database_hostname') ? ' has-error ' : '' }}" autocomplete="off" value="127.0.0.1" placeholder="{{ trans('cms::installer.environment.wizard.form.db_host_placeholder') }}">

                                    @if ($errors->has('database_hostname'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('database_hostname') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <label for="database_port" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.db_port_label') }}
                                    </label>
                                    <input type="text" name="database_port" id="database_port" class="input {{ $errors->has('database_port') ? ' has-error ' : '' }}" value="3306"
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.db_port_placeholder') }}"
                                    autocomplete="off">

                                    @if ($errors->has('database_port'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('database_port') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="database_name" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.db_name_label') }}
                                    </label>
                                    <input type="text" name="database_name" id="database_name" class="input {{ $errors->has('database_name') ? ' has-error ' : '' }}" value="{{ old('database_name') }}"
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.db_name_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('database_name'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('database_name') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <label for="db-prefix" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.db_prefix_label') }}
                                    </label>
                                    <input type="text" name="database_prefix" id="database_prefix" class="input {{ $errors->has('database_prefix') ? ' has-error ' : '' }}" value="{{ old('database_prefix', 'app_') }}"
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.db_prefix_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('database_prefix'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('database_prefix') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="database_username" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.db_username_label') }}
                                    </label>
                                    <input type="text" name="database_username" id="database_username" class="input {{ $errors->has('database_username') ? ' has-error ' : '' }}" value="{{ old('database_username') }}"
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.db_username_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('database_username'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('database_username') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <label for="database_password" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.db_password_label') }}
                                    </label>
                                    <input type="password" name="database_password" id="database_password" class="input {{ $errors->has('database_password') ? ' has-error ' : '' }}" value=""
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.db_password_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('database_password'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('database_password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Mail Configuration</h3>
                            <div class="space-y-2">
                                <label for="mail_driver" class="text-sm font-medium">
                                    {{ trans('cms::installer.environment.wizard.form.mail_driver_label') }}
                                </label>
                                <select id="mail_driver" name="mail_driver" class="select">
                                    <option value="smtp" selected>
                                        {{ trans('cms::installer.environment.wizard.form.mail_driver_label_smtp') }}
                                    </option>
                                    <option value="sendmail">
                                        {{ trans('cms::installer.environment.wizard.form.mail_driver_label_sendmail') }}
                                    </option>
                                    <option value="mailgun">
                                        {{ trans('cms::installer.environment.wizard.form.mail_driver_label_mailgun') }}
                                    </option>
                                    <option value="ses">
                                        {{ trans('cms::installer.environment.wizard.form.mail_driver_label_ses') }}
                                    </option>
                                </select>
                                @if ($errors->has('mail_driver'))
                                    <span class="error-block">
                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                        {{ $errors->first('mail_driver') }}
                                    </span>
                                @endif
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="smtp_host" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.smtp_host_label') }}
                                    </label>
                                    <input type="text" name="smtp_host" id="smtp_host" class="input {{ $errors->has('smtp_host') ? ' has-error ' : '' }}" value=""
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.smtp_host_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('smtp_host'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('smtp_host') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <label for="smtp_port" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.smtp_port_label') }}
                                    </label>
                                    <input type="text" name="smtp_port" id="smtp_port" class="input {{ $errors->has('smtp_port') ? ' has-error ' : '' }}" value=""
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.smtp_port_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('smtp_port'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('smtp_port') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="smtp_username" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.smtp_username_label') }}
                                    </label>
                                    <input type="text" name="smtp_username" id="smtp_username" class="input {{ $errors->has('smtp_username') ? ' has-error ' : '' }}" value=""
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.smtp_username_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('smtp_username'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('smtp_username') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <label for="smtp_password" class="text-sm font-medium">
                                        {{ trans('cms::installer.environment.wizard.form.smtp_password_label') }}
                                    </label>
                                    <input type="password" name="smtp_password" id="smtp_password" class="input {{ $errors->has('smtp_password') ? ' has-error ' : '' }}" value=""
                                    placeholder="{{ trans('cms::installer.environment.wizard.form.smtp_password_placeholder') }}"
                                    autocomplete="off">
                                    @if ($errors->has('smtp_password'))
                                        <span class="error-block">
                                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                            {{ $errors->first('smtp_password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-blue">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium">{{ trans('cms::installer.important_note') }}</p>
                            <p class="mt-1">{{ trans('cms::installer.important_note_message') }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('installer.requirements') }}"
                            class="button button-outline w-full sm:w-auto">
                            {{ trans('cms::installer.back') }}
                        </a>
                        <div class="buttons">
                            <button class="button btn-submit">
                                {{ trans('cms::installer.environment.wizard.form.buttons.setup_application') }}
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
        function checkEnvironment(val) {
            var element = document.getElementById('environment_text_input');
            if (val == 'other') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }

        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }

        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }

        $('form').on('submit', function() {
            $('.btn-submit')
                .html("{{ trans('cms::app.please_wait') }}")
                .prop('disabled', true);
        });
    </script>
@endsection
