{{ Field::select(
    trans('cms::app.mode'),
    'data[mode]',
    [
        'value' => $data['mode'] ?? '',
        'options' => [
            'test' => trans('cms::app.test'),
            'live' => trans('cms::app.live'),
        ],
    ]
)}}

{{ Field::text(
    trans('cms::app.test_key_id'),
    'data[test_key_id]',
    [
        'value' => $data['test_key_id'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.test_key_secret'),
    'data[test_key_secret]',
    [
        'value' => $data['test_key_secret'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.live_key_id'),
    'data[live_key_id]',
    [
        'value' => $data['live_key_id'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.live_key_secret'),
    'data[live_key_secret]',
    [
        'value' => $data['live_key_secret'] ?? ''
    ]
)}}
