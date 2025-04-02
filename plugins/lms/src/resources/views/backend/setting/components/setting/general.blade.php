 <div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ trans('lms::content.store_address') }}</h5>
        <div class="card-subtitle">
            {{ __('This is where your business is located. This address will be used on invoices and for tax calculations.') }}
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
            {{ __('Configure how prices and currencies are displayed on your LMS.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select('Currency', 'lms_currency', [
                    'value' => get_config('lms_currency', 'USD'),
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
                {{ Field::select('Currency Position', 'lms_currency_position', [
                    'value' => get_config('lms_currency_position', 'left'),
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
                {{ Field::text('Thousand Separator', 'lms_thousand_separator', [
                    'value' => get_config('lms_thousand_separator', ','),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::text('Decimal Separator', 'lms_decimal_separator', [
                    'value' => get_config('lms_decimal_separator', '.'),
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="col-md-4">
                {{ Field::select('Number of Decimals', 'lms_number_of_decimals', [
                    'value' => get_config('lms_number_of_decimals', '2'),
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