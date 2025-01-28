@component('cms::components.form', [
    'method' => 'post',
    'action' => route('admin.theme.setting'),
])
    <div class="card">
        <div class="card-header bg-transparent justify-content-end align-items-center">
            <div class="actions-buttons">
                <button type="submit" class="btn btn-tabler me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    {{ trans('cms::app.save') }}
                </button>
                <button type="reset" class="btn btn-teal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                    {{ trans('cms::app.reset') }}
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-4 mb-3">
                <div class="col-md-12">
                    <form action="{{ route('admin.theme.setting') }}" method="post" class="form-ajax">
                        <h4>{{ trans('cms::app.media_setting.thumbnail_settings') }}</h4>

                        @foreach($postTypes as $key => $postType)
                            <h5>{{ $postType->get('label') }}</h5>
                            <label>{{ trans('cms::app.media_setting.thumbnail_size') }}</label>
                            @php
                            $thumbnailSize = get_thumbnail_size($key, $thumbnailSizes ?? []);
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Field::text(
                                        trans('cms::app.media_setting.max_width'),
                                        "theme[thumbnail_sizes][{$key}][width]",
                                        [
                                            'value' => $thumbnailSize['width'],
                                        ]
                                    ) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Field::text(
                                        trans('cms::app.media_setting.max_height'),
                                        "theme[thumbnail_sizes][{$key}][height]",
                                        [
                                            'value' => $thumbnailSize['height'],
                                        ]
                                    ) }}
                                </div>
                            </div>

                            {{ Field::checkbox(
                                    trans('cms::app.media_setting.auto_resize_thumbnail'),
                                    "config[auto_resize_thumbnail][{$key}]",
                                    [
                                        'checked' => get_config('auto_resize_thumbnail', [])[$key] ?? false,
                                    ]
                            )
                            }}

                            {{ Field::image(
                                trans('cms::app.media_setting.thumbnail_default'),
                                "config[thumbnail_defaults][{$key}]",
                                [
                                    'value' => $thumbnailDefaults[$key] ?? null
                                ]
                            ) }}
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="row g-2 align-items-center">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-tabler me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
        </div>
    </div>
@endcomponent

