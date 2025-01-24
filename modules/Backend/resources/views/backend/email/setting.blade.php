
<div class="card">
    <div class="row g-0">
        <div class="col-12 col-md-12">
            @php
            $config = get_config('email');
            @endphp

            <form action="{{ route('admin.setting.email.save') }}" method="post" class="form-ajax h-100 d-flex flex-column">
                <div class="card-header bg-transparent justify-content-end align-items-center">
                    <div class="actions-buttons">
                        <button type="submit" class="btn btn-tabler me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                            {{ trans('cms::app.save') }}
                        </button>
                        <button type="reset" class="btn btn-teal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                            </svg>
                            {{ trans('cms::app.reset') }}
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @component('cms::components.form_input', [
                        'label' => trans('cms::app.email_host'),
                        'name' => 'email[host]',
                        'value' => $config['host'] ?? '',
                    ])@endcomponent

                    <div class="row">
                        <div class="col-md-6">
                            @component('cms::components.form_input', [
                                'label' => trans('cms::app.email_port'),
                                'name' => 'email[port]',
                                'value' => $config['port'] ?? '',
                            ])@endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('cms::components.form_select', [
                                'label' => trans('cms::app.email_encryption'),
                                'name' => 'email[encryption]',
                                'value' => $config['encryption'] ?? '',
                                'options' => [
                                    '' => 'none',
                                    'tls' => 'tls',
                                    'ssl' => 'ssl'
                                ],
                            ])@endcomponent
                        </div>
                    </div>

                    @component('cms::components.form_input', [
                        'label' => trans('cms::app.email_username'),
                        'name' => 'email[username]',
                        'value' => $config['username'] ?? '',
                    ])@endcomponent

                    @component('cms::components.form_input', [
                        'label' => trans('cms::app.email_password'),
                        'name' => 'email[password]',
                        'value' => $config['password'] ?? '',
                    ])@endcomponent

                    <hr>

                    @component('cms::components.form_input', [
                        'label' => trans('cms::app.email_from_address'),
                        'name' => 'email[from_address]',
                        'value' => $config['from_address'] ?? '',
                    ])@endcomponent

                    @component('cms::components.form_input', [
                        'label' => trans('cms::app.email_from_name'),
                        'name' => 'email[from_name]',
                        'value' => $config['from_name'] ?? '',
                    ])@endcomponent
                </div>

                <div class="card-footer bg-transparent mt-auto">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-tabler me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                {{ trans('cms::app.save') }}
                            </button>
                            <button type="reset" class="btn btn-teal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                </svg>
                                {{ trans('cms::app.reset') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 col-md-12">
            <div class="card-body">
                <h5 class="mb-3">{{ trans('cms::app.send_email_test') }}</h5>
                <form action="{{ route('admin.setting.email.test-email') }}" method="post" class="form-ajax">
                    @component('cms::components.form_input', [
                        'label' => trans('cms::app.email'),
                        'name' => 'email',
                        'required' => true,
                    ])@endcomponent

                    <button type="submit" class="btn btn-tabler">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 14l11 -11"/>
                            <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"/>
                        </svg>
                        {{ trans('cms::app.send_email_test') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
