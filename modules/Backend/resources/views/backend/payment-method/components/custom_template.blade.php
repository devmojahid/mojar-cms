{{ Field::textarea(
    trans('cms::app.payment_description'),
    'data[description]',
    [
        'value' => $data['description'] ?? ''
    ]
) }}