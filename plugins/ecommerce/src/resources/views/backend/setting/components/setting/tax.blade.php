<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Tax Options') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure how taxes are calculated and displayed.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Taxes'), '_enable_taxes', [
                        'value' => get_config('_enable_taxes', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Enable tax calculations for products.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Tax Calculation Based On'), '_tax_base', [
                    'value' => get_config('_tax_base', 'billing'),
                    'options' => [
                        'billing' => __('Customer billing address'),
                        'shipping' => __('Customer shipping address'),
                        'shop' => __('Shop base address'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('The address used to calculate taxes.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::select(__('Display Prices in Shop'), '_tax_display_shop', [
                    'value' => get_config('_tax_display_shop', 'incl'),
                    'options' => [
                        'incl' => __('Including tax'),
                        'excl' => __('Excluding tax'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('How prices are displayed in the shop.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Display Prices in Cart and Checkout'), '_tax_display_cart', [
                    'value' => get_config('_tax_display_cart', 'incl'),
                    'options' => [
                        'incl' => __('Including tax'),
                        'excl' => __('Excluding tax'),
                    ],
                    'class' => 'form-select',
                ]) }}
                <small class="form-text text-muted">{{ __('How prices are displayed during checkout.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Show Tax Totals'), '_tax_show_totals', [
                        'value' => get_config('_tax_show_totals', 1),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Show a tax total line in cart and checkout.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Include Tax in Prices'), '_tax_included_in_price', [
                        'value' => get_config('_tax_included_in_price', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Products prices include taxes when entered.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Standard Tax Rates') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure tax rates for different countries or states.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            {{ __('These are the standard tax rates applied to products without a specific tax class.') }}
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Country') }}</th>
                        <th>{{ __('State/Province') }}</th>
                        <th>{{ __('Zip/Postal Code') }}</th>
                        <th>{{ __('Rate %') }}</th>
                        <th>{{ __('Tax Name') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ Field::select('', '_tax_country_1', [
                                'value' => get_config('_tax_country_1', ''),
                                'options' => $countries ?? [],
                                'class' => 'form-select',
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_state_1', [
                                'value' => get_config('_tax_state_1', ''),
                                'class' => 'form-control',
                                'placeholder' => __('Any'),
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_zip_1', [
                                'value' => get_config('_tax_zip_1', ''),
                                'class' => 'form-control',
                                'placeholder' => __('Any'),
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_rate_1', [
                                'value' => get_config('_tax_rate_1', ''),
                                'class' => 'form-control',
                                'placeholder' => '10',
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_name_1', [
                                'value' => get_config('_tax_name_1', ''),
                                'class' => 'form-control',
                                'placeholder' => __('VAT'),
                            ]) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ Field::select('', '_tax_country_2', [
                                'value' => get_config('_tax_country_2', ''),
                                'options' => $countries ?? [],
                                'class' => 'form-select',
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_state_2', [
                                'value' => get_config('_tax_state_2', ''),
                                'class' => 'form-control',
                                'placeholder' => __('Any'),
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_zip_2', [
                                'value' => get_config('_tax_zip_2', ''),
                                'class' => 'form-control',
                                'placeholder' => __('Any'),
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_rate_2', [
                                'value' => get_config('_tax_rate_2', ''),
                                'class' => 'form-control',
                                'placeholder' => '10',
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_name_2', [
                                'value' => get_config('_tax_name_2', ''),
                                'class' => 'form-control',
                                'placeholder' => __('VAT'),
                            ]) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ Field::select('', '_tax_country_3', [
                                'value' => get_config('_tax_country_3', ''),
                                'options' => $countries ?? [],
                                'class' => 'form-select',
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_state_3', [
                                'value' => get_config('_tax_state_3', ''),
                                'class' => 'form-control',
                                'placeholder' => __('Any'),
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_zip_3', [
                                'value' => get_config('_tax_zip_3', ''),
                                'class' => 'form-control',
                                'placeholder' => __('Any'),
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_rate_3', [
                                'value' => get_config('_tax_rate_3', ''),
                                'class' => 'form-control',
                                'placeholder' => '10',
                            ]) }}
                        </td>
                        <td>
                            {{ Field::text('', '_tax_name_3', [
                                'value' => get_config('_tax_name_3', ''),
                                'class' => 'form-control',
                                'placeholder' => __('VAT'),
                            ]) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> 