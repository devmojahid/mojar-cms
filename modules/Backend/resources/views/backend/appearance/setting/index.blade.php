@extends('cms::layouts.backend')

@section('content')
    <form action="" method="post" class="form-ajax">
        <div class="card">
            <div class="card-header bg-transparent justify-content-between align-items-center">
                <div class="header-title">
                    <h5 class="card-title">{{ trans('cms::app.theme_setting') }}</h5>
                </div>
                <div class="actions-buttons">
                    <button type="submit" class="btn btn-tabler me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        {{ trans('cms::app.save') }}
                    </button>
                    <button type="reset" class="btn btn-teal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                        {{ trans('cms::app.reset') }}
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($configs as $config)
                            @php
                                $config['data']['value'] = get_theme_config($config['name']);
                                $config['name'] = "theme[{$config['name']}]";
                            @endphp

                            {{ Field::fieldByType($config) }}
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        {{ Field::image(trans('cms::app.logo'), 'config[logo]', [
                            'value' => get_config('logo'),
                        ]) }}

                        {{ Field::image(trans('cms::app.icon'), 'config[icon]', [
                            'value' => get_config('icon'),
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
