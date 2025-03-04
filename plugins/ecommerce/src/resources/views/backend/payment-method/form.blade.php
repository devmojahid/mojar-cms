@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model,
    ])
        <input type="hidden" name="id" value="{{ $model->id }}">

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    @component('cms::components.card', [
                        'label' => trans('cms::app.general'),
                    ])
                        {{ Field::select($model, 'type', [
                            'disabled' => $model->id ? true : false,
                            'required' => true,
                            'label' => trans('cms::app.method'),
                            'options' => array_merge(
                                ['' => '--- ' . trans('cms::app.payment_method') . ' ---'],
                                [
                                    'paypal' => 'Paypal',
                                    'custom' => 'Custom',
                                    'stripe' => 'Stripe',
                                    'razorpay' => 'Razorpay',
                                    'mollie' => 'Mollie',
                                    'bank_transfer' => 'Bank Transfer',
                                    'cod' => 'Cash On Delivery',
                                ],
                            ),
                        ]) }}

                        {{ Field::text($model, 'name', [
                            'required' => true,
                        ]) }}

                        {{ Field::textarea($model, 'description') }}
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('cms::components.card', [
                        'label' => trans('cms::app.config'),
                        'class' => $model->data ? 'box-data' : 'box-hidden box-data',
                    ])
                        {{-- @if ($model->type == 'paypal')
                            @component('cms::backend.payment-method.components.paypal_template', [
                                'data' => $model->data,
                            ])
                            @endcomponent
                        @endif

                        @if ($model->type == 'custom')
                            @component('cms::backend.payment-method.components.custom_template', [
                                'data' => $model->data,
                            ])
                            @endcomponent
                        @endif --}}

                        @foreach (['paypal', 'custom', 'stripe', 'razorpay', 'mollie', 'bank_transfer', 'cod'] as $type)
                            @if ($model->type == $type)
                                @component('ecomm::backend.payment-method.components.' . $type . '_template', [
                                    'data' => $model->data,
                                ])
                                @endcomponent
                            @endif
                        @endforeach
                    @endcomponent
                </div>
            </div>


            <div class="col-md-4">
                @component('cms::components.card', [
                    'label' => trans('cms::app.status'),
                ])
                    {{ Field::checkbox($model, 'active', [
                        'checked' => $model->active == 1 || is_null($model->active),
                    ]) }}
                @endcomponent
            </div>
        </div>
    @endcomponent

    {{-- <template id="data-custom">
        @component('cms::backend.payment-method.components.custom_template')
        @endcomponent
    </template>

    <template id="data-paypal">
        @component('cms::backend.payment-method.components.paypal_template')
        @endcomponent
    </template> --}}

    @foreach(['paypal', 'stripe', 'razorpay', 'mollie', 'bank_transfer', 'cod'] as $type)
    <template id="data-{{ $type }}">
        @component("ecomm::backend.payment-method.components.{$type}_template")
        @endcomponent
        </template>
    @endforeach

    <script type="text/javascript">
        $('select[name=type]').on('change', function() {
            let type = $(this).val();
            let name = $(this).find('option:selected').text().trim();

            if (type && type !== 'custom') {
                $('input[name=name]').val(name);
            } else {
                $('input[name=name]').val('');
            }

            $('.box-data .card-body').empty();
            let template = document.getElementById('data-' + type);
            if (template) {
                template = template.innerHTML;
                $('.box-data .card-body').html(template);
                $('.box-data').show('slow');
            } else {
                $('.box-data').hide();
            }
        });
    </script>

@endsection
