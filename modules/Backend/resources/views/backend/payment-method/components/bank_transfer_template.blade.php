{{ Field::textarea(
    trans('cms::app.bank_details'),
    'data[bank_details]',
    [
        'value' => $data['bank_details'] ?? '',
        'rows' => 5,
        'placeholder' => trans('cms::app.enter_bank_details')
    ]
)}}
