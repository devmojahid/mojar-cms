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
    trans('cms::app.sandbox_client_id'),
    'data[sandbox_client_id]',
    [
        'value' => $data['sandbox_client_id'] ?? ''
    ]
) }}


{{ Field::text(
    trans('cms::app.sandbox_secret'),
    'data[sandbox_secret]',
    [
        'value' => $data['sandbox_secret'] ?? ''
    ]
) }}


{{ Field::text(
    trans('cms::app.live_client_id'),
    'data[live_client_id]',
    [
        'value' => $data['live_client_id'] ?? ''
    ]
) }}


{{ Field::text(
    trans('cms::app.live_secret'),
    'data[live_secret]',
    [
        'value' => $data['live_secret'] ?? ''
    ]
) }}