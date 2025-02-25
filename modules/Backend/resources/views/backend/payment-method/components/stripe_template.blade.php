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
    trans('cms::app.test_publishable_key'),
    'data[test_publishable_key]',
    [
        'value' => $data['test_publishable_key'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.test_secret_key'),
    'data[test_secret_key]',
    [
        'value' => $data['test_secret_key'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.live_publishable_key'),
    'data[live_publishable_key]',
    [
        'value' => $data['live_publishable_key'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.live_secret_key'),
    'data[live_secret_key]',
    [
        'value' => $data['live_secret_key'] ?? ''
    ]
)}}



{{-- modules\Backend\resources\views\backend\payment-method\components\stripe_template.blade.php --}}

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
    trans('cms::app.test_publishable_key'),
    'data[test_publishable_key]',
    [
        'value' => $data['test_publishable_key'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.test_secret_key'),
    'data[test_secret_key]',
    [
        'value' => $data['test_secret_key'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.live_publishable_key'),
    'data[live_publishable_key]',
    [
        'value' => $data['live_publishable_key'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.live_secret_key'),
    'data[live_secret_key]',
    [
        'value' => $data['live_secret_key'] ?? ''
    ]
)}}

{{-- Example extra field for a webhook signing secret: --}}
{{ Field::text(
    'Webhook Secret',
    'data[webhook_secret]',
    [
        'value' => $data['webhook_secret'] ?? '',
        'label' => 'Stripe Webhook Secret',
    ]
)}}
