@extends('cms::layouts.backend')
@section('content')
    <div class="card">
        <div class="card-header justify-content-between">
            <div>
                <h2 class="page-title mb-2">
                    {{ $forms[$component]->get('name') }}
                </h2>
                <div class="text-muted">
                    Manage your application settings and preferences
                </div>
            </div>
            <div>
                <div class="btn-list">
                    <a href="{{ route('admin.setting.form', [$page, 1]) }}"
                        class="btn btn-outline-primary d-none d-sm-inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                            </path>
                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                        </svg>
                        All Settings
                    </a>
                    <span class="d-none d-sm-inline">
                        <a href="#" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Documentation">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 17l0 .01"></path>
                                <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row g-0">
            @if ($forms->count() > 1)
                <div class="col-12 col-md-3 border-end">
                    <div class="card-body">
                        <div class="list-group list-group-transparent">
                            @foreach ($forms as $key => $form)
                                <a href="{{ route('admin.setting.form', [$page, $key]) }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center @if ($key == $component) active @endif">
                                    {{ $form->get('name') }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12 col-md-{{ $forms->count() > 1 ? '9' : '12' }} d-flex flex-column">
                @if (isset($forms[$component]['view']))
                    @if (is_string($forms[$component]['view']))
                        @if (view()->exists($forms[$component]['view']))
                            @include($forms[$component]['view'])
                        @endif
                    @else
                        {{ $forms[$component]['view'] }}
                    @endif
                @else
                    <form action="{{ route('admin.setting.save') }}" method="post"
                        class="form-ajax h-100 d-flex flex-column">
                        <input type="hidden" name="form" value="{{ $component }}">

                        <div class="card-body">
                            @foreach ($configs as $key => $config)
                                @php
                                    if ($config['type'] == 'checkbox') {
                                        $config['data']['value'] = $config['data']['value'] ?? 1;
                                        $config['data']['checked'] =
                                            get_config($key, $config['data']['default'] ?? null) ==
                                            ($config['data']['value'] ?? null);
                                    } else {
                                        $config['data']['value'] = get_config($key);
                                    }
                                @endphp

                                {{ Field::fieldByType($config) }}
                            @endforeach

                            @do_action("setting_form_{$component}")
                        </div>

                        @if ($forms[$component]['footer'] ?? true)
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <div class="btn-group float-right">
                                            <button type="submit" class="btn btn-success">
                                                {{ trans('cms::app.save') }}
                                            </button>

                                            <button type="reset" class="btn btn-default">
                                                {{ trans('cms::app.reset') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($forms[$component]['footer'] ?? true)
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-tabler me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                            </svg>
                                            {{ trans('cms::app.save') }}
                                        </button>

                                        <button type="reset" class="btn btn-teal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                            </svg>
                                            {{ trans('cms::app.reset') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
