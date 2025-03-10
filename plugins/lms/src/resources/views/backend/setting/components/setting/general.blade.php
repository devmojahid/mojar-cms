<h5>{{ trans('lms::content.store_address') }}</h5>
<em>This is where your business is located. Tax rates and shipping rates will use this address.</em>

<div class="row">
    <div class="col-md-12">
        {{ Field::text('Store Address 1', '_store_address1', [
            'value' => get_config('_store_address1'),
        ]) }}

        {{ Field::text('Store Address 2', '_store_address2', [
            'value' => get_config('_store_address2'),
        ]) }}

        {{ Field::text('City', '_city', [
            'value' => get_config('_city'),
        ]) }}

        {{ Field::select('Country / State', '_city', [
            'value' => get_config('_country'),
            'class' => 'load-countries',
        ]) }}

        {{ Field::text('Postcode / ZIP', '_zipcode', [
            'value' => get_config('_zipcode'),
        ]) }}
    </div>
</div>

{{--<h5>General options</h5>
<div class="row">
    <div class="col-md-12">
        {{ Field::select('Selling location(s)', '_selling_locations', [
            'value' => get_config('_selling_locations'),
            'options' => [
                'all' => 'Sell to all countries',
                'all_except' => 'Sell to all countries, except for...',
                'specific' => 'Sell to specific countries',
            ]
        ]) }}

        {{ Field::select('Shipping location(s)', '_shipping_locations', [
            'value' => get_config('_shipping_locations'),
            'options' => [
                'all' => 'Ship to all countries',
                'all_except' => 'Ship to all countries, except for...',
                'specific' => 'Ship to specific countries',
            ]
        ]) }}
    </div>
</div>--}}

{{--<h5>Currency options</h5>
<em>The following options affect how prices are displayed on the frontend.</em>

<div class="row">
    <div class="col-md-12">
        {{ Field::select('Currency', '_currency', [
            'value' => get_config('_currency'),
        ]) }}

        {{ Field::select('Currency position', '_currency', [
            'value' => get_config('_currency'),
        ]) }}

        {{ Field::text('Thousand separator', '_thousand_separator', [
            'value' => get_config('_thousand_separator'),
        ]) }}

        {{ Field::text('Decimal separator', '_decimal_separator', [
            'value' => get_config('_decimal_separator'),
        ]) }}

        {{ Field::text('Number of decimals', '_number_of_decimals', [
            'value' => get_config('_number_of_decimals'),
        ]) }}
    </div>
</div>--}}
