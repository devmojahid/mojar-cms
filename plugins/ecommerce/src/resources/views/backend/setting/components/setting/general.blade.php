<style>
    .ecommerce-settings .card-title {
        margin-right: 5px;
    }
</style>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ trans('ecomm::content.store_address') }}</h5>
        <div class="card-subtitle">
            {{ __('This is where your business is located. Tax rates and shipping rates will use this address.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text('Store Address 1', '_store_address1', [
                    'value' => get_config('_store_address1'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::text('Store Address 2', '_store_address2', [
                    'value' => get_config('_store_address2'),
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                {{ Field::text('City', '_city', [
                    'value' => get_config('_city'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::select('Country', '_country', [
                    'value' => get_config('_country'),
                    'options' => $countries ?? [],
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::text('Postcode / ZIP', '_zipcode', [
                    'value' => get_config('_zipcode'),
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Currency Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how prices and currencies are displayed on your store.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Currency', '_currency', [
                    'value' => get_config('_currency', 'USD'),
                    'options' => [
                        'USD' => 'US Dollar ($)',
                        'EUR' => 'Euro (€)',
                        'GBP' => 'British Pound (£)',
                        'JPY' => 'Japanese Yen (¥)',
                        'INR' => 'Indian Rupee (₹)',
                        'CAD' => 'Canadian Dollar (C$)',
                        'AUD' => 'Australian Dollar (A$)',
                        'SGD' => 'Singapore Dollar (S$)',
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::select('Currency Position', '_currency_position', [
                    'value' => get_config('_currency_position', 'left'),
                    'options' => [
                        'left' => 'Left ($99.99)',
                        'right' => 'Right (99.99$)',
                        'left_space' => 'Left with space ($ 99.99)',
                        'right_space' => 'Right with space (99.99 $)',
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                {{ Field::text('Thousand Separator', '_thousand_separator', [
                    'value' => get_config('_thousand_separator', ','),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::text('Decimal Separator', '_decimal_separator', [
                    'value' => get_config('_decimal_separator', '.'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::select('Number of Decimals', '_number_of_decimals', [
                    'value' => get_config('_number_of_decimals', '2'),
                    'options' => [
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>
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
