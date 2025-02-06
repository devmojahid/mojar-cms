@php
    /**
     * @var \Juzaweb\Backend\Models\Post $model
     * @var \Juzaweb\Ecommerce\Models\ProductVariant $variant
     */
@endphp

<div class="card mt-3 mb-3">
    <div class="card-header">
        <div class="d-flex flex-column justify-content-center">
            <h5 class="mb-0">{{ __('Event Info') }}</h5>
        </div>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                {{ Field::text(trans('ecom::content.price'), 'meta[price]', [
                    'value' => $model->getMeta('price') ? number_format($model->getMeta('price')) : '',
                    'class' => 'is-number number-format',
                    'prefix' => '$'

                ]) }}
            </div>

            <div class="col-md-6">
                {{ Field::text(trans('ecom::content.compare_price'), 'meta[compare_price]', [
                    'value' => $model->getMeta('compare_price') ? number_format($model->getMeta('compare_price')) : '',
                    'class' => 'is-number number-format',
                    'prefix' => '$'
                ]) }}

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{ Field::text(trans('ecom::content.sku_code'), 'meta[sku_code]', [
                    'value' => $model->getMeta('sku_code') ?? '',
                ]) }}
            </div>


            <div class="col-md-6">
                {{ Field::text(trans('ecom::content.barcode'), 'meta[barcode]', [
                    'value' => $model->getMeta('barcode') ?? '',
                ]) }}
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                {{ Field::checkbox(
                    trans('ecom::content.inventory_management'),
                    'meta[inventory_management]',
                    [
                        'checked' => $model->getMeta('inventory_management') == 1,
                    ]
                ) }}

                {{ Field::text(trans('ecom::content.quantity'), 'meta[quantity]', [
                    'value' => $model->getMeta('quantity') ?? '',
                    'class' => 'is-number number-format'
                ]) }}

                {{ Field::checkbox(
                    trans('ecom::content.allows_ordering_out_of_stock'),
                    'meta[disable_out_of_stock]',
                    [
                        'checked' => $model->getMeta('disable_out_of_stock') == 1,
                    ]
                ) }}
            </div>
        </div>
    </div>
</div>


<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex flex-column justify-content-center">
            <h5 class="mb-0">{{ __('Brand Area') }}</h5>
        </div>
    </div>

    <div class="card-body">
        {{ Field::images(trans('ecom::content.images'), 'meta[images]', [
            'value' => $model->getMeta('images', []),
        ]) }}
    </div>
</div>
