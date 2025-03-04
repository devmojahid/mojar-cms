{{ Field::textarea(
    trans('cms::app.bank_details'),
    'data[bank_details]',
    [
        'value' => $data['bank_details'] ?? '',
        'rows' => 5,
        'placeholder' => trans('cms::app.enter_bank_details')
    ]
)}}


{{ Field::text(
    trans('cms::app.bank_name'),
    'data[bank_name]',
    [
        'value' => $data['bank_name'] ?? ''
    ]
)}}

{{ Field::text(
    trans('cms::app.account_number'),
    'data[account_number]',
    [
        'value' => $data['account_number'] ?? ''
    ]
)}}

{{ Field::textarea(
    trans('cms::app.instructions'),
    'data[instructions]',
    [
        'value' => $data['instructions'] ?? '',
        'label' => trans('cms::app.instructions'),
        'rows' => 3,
    ]
)}}
