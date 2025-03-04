{{
    Field::select(
        trans('cms::app.mode'),
        'data[mode]',
        [
            'value' => $data['mode'] ?? '',
            'options' => [
                'sandbox' => trans('cms::app.sandbox'),
                'live' => trans('cms::app.live'),
            ],
        ]
    )
}}
{{ Field::text(
    trans('cms::app.sandbox_api_key'),
    'data[sandbox_api_key]',
    [
        'value' => $data['sandbox_api_key'] ?? ''
    ]
) }}
{{ Field::text(
    trans('cms::app.live_api_key'),
    'data[live_api_key]',
    [
        'value' => $data['live_api_key'] ?? ''
    ]
) }}