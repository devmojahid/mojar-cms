<div class="row">
    <div class="col-md-8">

        <div class="row">
            <div class="col-md-6">
                {{ Field::text($model, 'code', [
                    'disabled' => true
                ]) }}

                {{ Field::text($model, 'name', [
                    'disabled' => true
                ]) }}
            </div>

            <div class="col-md-6">
                {{ Field::text($model, 'phone', [
                    'disabled' => true,
                    'label' => trans('ecomm::content.phone')
                ]) }}

                {{ Field::text($model, 'email', [
                    'disabled' => true
                ]) }}
            </div>
        </div>

        {{ Field::text($model, 'address', [
            'disabled' => true,
            'label' => trans('ecomm::content.address')
        ]) }}

        {{ Field::text($model, 'other_address', [
            'disabled' => true,
            'label' => trans('ecomm::content.other_address')
        ]) }}

        {{ Field::textarea($model, 'notes') }}
    </div>

    <div class="col-md-4">
        {{ Field::select($model, 'payment_method_id', [
            'label' => trans('ecomm::content.payment_method'),
            'options' => $paymentMethods
        ]) }}

        {{ Field::select($model, 'payment_status', [
            'label' => trans('ecomm::content.payment_status'),
            'options' => $statuses
        ]) }}

        {{--{{ Field::select($model, 'shipping_status', [
            'label' => trans('ecomm::content.shipping_status'),
        ]) }}--}}
    </div>
</div>
