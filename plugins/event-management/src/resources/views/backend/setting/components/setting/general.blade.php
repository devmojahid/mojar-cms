<h5>{{ trans('evman::content.store_address') }}</h5>
<em>This is where your business is located. Tax rates and shipping rates will use this address.</em>

<div class="row">
    <div class="col-md-12">
        {{ Field::text('Store Address 1', 'evman_store_address1', [
            'value' => get_config('evman_store_address1'),
        ]) }}

        {{ Field::text('Store Address 2', 'evman_store_address2', [
            'value' => get_config('evman_store_address2'),
        ]) }}

        {{ Field::text('City', 'evman_city', [
            'value' => get_config('evman_city'),
        ]) }}

        {{ Field::select('Country / State', 'evman_city', [
            'value' => get_config('evman_country'),
            'class' => 'load-countries',
        ]) }}

        {{ Field::text('Postcode / ZIP', 'evman_zipcode', [
            'value' => get_config('evman_zipcode'),
        ]) }}
    </div>
</div>

{{--<h5>General options</h5>
<div class="row">
    <div class="col-md-12">
        {{ Field::select('Selling location(s)', 'evman_selling_locations', [
            'value' => get_config('evman_selling_locations'),
            'options' => [
                'all' => 'Sell to all countries',
                'all_except' => 'Sell to all countries, except for...',
                'specific' => 'Sell to specific countries',
            ]
        ]) }}

        {{ Field::select('Shipping location(s)', 'evman_shipping_locations', [
            'value' => get_config('evman_shipping_locations'),
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
        {{ Field::select('Currency', 'evman_currency', [
            'value' => get_config('evman_currency'),
        ]) }}

        {{ Field::select('Currency position', 'evman_currency', [
            'value' => get_config('evman_currency'),
        ]) }}

        {{ Field::text('Thousand separator', 'evman_thousand_separator', [
            'value' => get_config('evman_thousand_separator'),
        ]) }}

        {{ Field::text('Decimal separator', 'evman_decimal_separator', [
            'value' => get_config('evman_decimal_separator'),
        ]) }}

        {{ Field::text('Number of decimals', 'evman_number_of_decimals', [
            'value' => get_config('evman_number_of_decimals'),
        ]) }}
    </div>
</div>--}}
