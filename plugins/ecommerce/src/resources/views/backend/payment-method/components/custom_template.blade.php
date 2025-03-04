{{ Field::textarea(
    trans('cms::app.payment_description'),
    'data[description]',
    [
        'value' => $data['description'] ?? ''
    ]
) }}

{{ Field::textarea(
    trans('cms::app.custom_instructions'),
    'data[instructions]',
    [
        'value' => $data['instructions'] ?? '',
        'label' => trans('cms::app.custom_instructions'),
        'rows' => 4,
        'placeholder' => trans('cms::app.custom_instructions_placeholder'),
    ]
) }}

{{-- You can add more fields if you want. For instance: --}}

{{ Field::text(
    trans('cms::app.custom_field'),
    'data[custom_field]',
    [
        'value' => $data['custom_field'] ?? '',
        'label' => trans('cms::app.custom_field_label'),
    ]
) }}
