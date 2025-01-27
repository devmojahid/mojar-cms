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
        <div class="space-y-8">
            <div class="grid gap-6">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="app-name" class="text-sm font-medium">Application Name</label>
                        <input type="text" id="app-name" class="input" placeholder="My Application">
                    </div>
                    <div class="space-y-2">
                        <label for="app-url" class="text-sm font-medium">Application URL</label>
                        <input type="text" id="app-url" class="input" placeholder="https://example.com">
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Database Configuration</h3>
                    <div class="space-y-2">
                        <label for="db-type" class="text-sm font-medium">Database Type</label>
                        <select id="db-type" class="select">
                            <option value="mysql">MySQL</option>
                            <option value="postgresql">PostgreSQL</option>
                            <option value="sqlite">SQLite</option>
                            <option value="sqlserver">SQL Server</option>
                        </select>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="db-host" class="text-sm font-medium">Database Host</label>
                            <input type="text" id="db-host" class="input" placeholder="localhost">
                        </div>
                        <div class="space-y-2">
                            <label for="db-port" class="text-sm font-medium">Database Port</label>
                            <input type="text" id="db-port" class="input" placeholder="3306">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="db-name" class="text-sm font-medium">Database Name</label>
                            <input type="text" id="db-name" class="input" placeholder="my_database">
                        </div>
                        <div class="space-y-2">
                            <label for="db-prefix" class="text-sm font-medium">Table Prefix</label>
                            <input type="text" id="db-prefix" class="input" placeholder="app_">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="db-username" class="text-sm font-medium">Username</label>
                            <input type="text" id="db-username" class="input" placeholder="database_user">
                        </div>
                        <div class="space-y-2">
                            <label for="db-password" class="text-sm font-medium">Password</label>
                            <input type="password" id="db-password" class="input" placeholder="••••••••">
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Mail Configuration</h3>
                    <div class="space-y-2">
                        <label for="mail-driver" class="text-sm font-medium">Mail Driver</label>
                        <select id="mail-driver" class="select">
                            <option value="smtp">SMTP</option>
                            <option value="sendmail">Sendmail</option>
                            <option value="mailgun">Mailgun</option>
                            <option value="ses">Amazon SES</option>
                        </select>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="smtp-host" class="text-sm font-medium">SMTP Host</label>
                            <input type="text" id="smtp-host" class="input" placeholder="smtp.mailtrap.io">
                        </div>
                        <div class="space-y-2">
                            <label for="smtp-port" class="text-sm font-medium">SMTP Port</label>
                            <input type="text" id="smtp-port" class="input" placeholder="2525">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="smtp-username" class="text-sm font-medium">SMTP Username</label>
                            <input type="text" id="smtp-username" class="input" placeholder="smtp_user">
                        </div>
                        <div class="space-y-2">
                            <label for="smtp-password" class="text-sm font-medium">SMTP Password</label>
                            <input type="password" id="smtp-password" class="input" placeholder="••••••••">
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-blue">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <p class="font-medium">Important Note</p>
                    <p class="mt-1">Make sure your database credentials are correct. The installation process will attempt to create tables and seed initial data.</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="requirements.html" class="button button-outline w-full sm:w-auto">Previous</a>
                <a href="theme.html" class="button w-full sm:w-auto">Continue</a>
            </div>
        </div>
    </div>
</div>
    {{-- <form method="post" action="{{ route('installer.environment.save') }}" class="tabs-wrap" autocomplete="off">
        @csrf

        <div class="form-group">
            <label for="database_connection">
                {{ trans('cms::installer.environment.wizard.form.db_connection_label') }}
            </label>
            <select name="database_connection" id="database_connection">
                <option value="mysql" selected>{{ trans('cms::installer.environment.wizard.form.db_connection_label_mysql') }}</option>
                <option value="sqlite">{{ trans('cms::installer.environment.wizard.form.db_connection_label_sqlite') }}</option>
                <option value="pgsql">{{ trans('cms::installer.environment.wizard.form.db_connection_label_pgsql') }}</option>
                <option value="sqlsrv">{{ trans('cms::installer.environment.wizard.form.db_connection_label_sqlsrv') }}</option>
            </select>

            @if ($errors->has('database_connection'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_connection') }}
                </span>
            @endif

        </div>

        <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
            <label for="database_hostname">
                {{ trans('cms::installer.environment.wizard.form.db_host_label') }}
            </label>
            <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="{{ trans('cms::installer.environment.wizard.form.db_host_placeholder') }}" autocomplete="off" />
            @if ($errors->has('database_hostname'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_hostname') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
            <label for="database_port">
                {{ trans('cms::installer.environment.wizard.form.db_port_label') }}
            </label>
            <input type="number" name="database_port" id="database_port" value="3306" placeholder="{{ trans('cms::installer.environment.wizard.form.db_port_placeholder') }}" autocomplete="off" />
            @if ($errors->has('database_port'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_port') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
            <label for="database_name">
                {{ trans('cms::installer.environment.wizard.form.db_name_label') }}
            </label>
            <input type="text" name="database_name" id="database_name" value="{{ old('database_name') }}" placeholder="{{ trans('cms::installer.environment.wizard.form.db_name_placeholder') }}" autocomplete="off" />
            @if ($errors->has('database_name'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_name') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
            <label for="database_username">
                {{ trans('cms::installer.environment.wizard.form.db_username_label') }}
            </label>
            <input type="text" name="database_username" id="database_username" value="{{ old('database_username') }}" placeholder="{{ trans('cms::installer.environment.wizard.form.db_username_placeholder') }}" autocomplete="off" />
            @if ($errors->has('database_username'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_username') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
            <label for="database_password">
                {{ trans('cms::installer.environment.wizard.form.db_password_label') }}
            </label>
            <input type="password" name="database_password" id="database_password" value="" placeholder="{{ trans('cms::installer.environment.wizard.form.db_password_placeholder') }}" autocomplete="off" />
            @if ($errors->has('database_password'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_password') }}
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('database_prefix') ? ' has-error ' : '' }}">
            <label for="database_prefix">
                {{ trans('cms::installer.environment.wizard.form.db_prefix_label') }}
            </label>
            <input type="text" name="database_prefix" id="database_prefix" value="{{ old('database_prefix', 'jw_') }}" placeholder="{{ trans('cms::installer.environment.wizard.form.db_prefix_placeholder') }}" autocomplete="off" />
            @if ($errors->has('database_prefix'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('database_prefix') }}
                </span>
            @endif
        </div>

        <div class="buttons">
            <button class="button btn-submit">
                {{ trans('cms::installer.environment.wizard.form.buttons.setup_application') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form> --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }

        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }

        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }

        $('form').on('submit', function () {
            $('.btn-submit')
                .html("{{ trans('cms::app.please_wait') }}")
                .prop('disabled', true);
        });
    </script>
@endsection
