@php
    if (!function_exists('getAvailableCurrencyCodes')) {
    /**
     * Get list of available currency codes
     *
     * @return array
     */
    function getAvailableCurrencyCodes(): array
    {
        return [
            'USD' => 'US Dollar (USD)',
            'EUR' => 'Euro (EUR)',
            'GBP' => 'British Pound (GBP)',
            'JPY' => 'Japanese Yen (JPY)',
            'AUD' => 'Australian Dollar (AUD)',
            'CAD' => 'Canadian Dollar (CAD)',
            'CHF' => 'Swiss Franc (CHF)',
            'CNY' => 'Chinese Yuan (CNY)',
            'INR' => 'Indian Rupee (INR)',
            'BDT' => 'Bangladeshi Taka (BDT)',
            // Add more currencies as needed
        ];
    }
}
@endphp

<h5>{{ __('Multi‐Currency Settings') }}</h5>
<div class="form-group">
    {{ Field::checkbox(__('Enable Multi‐Currency'), 'ecomm_enable_multi_currency', [
        'checked' => get_config('ecomm_enable_multi_currency', 0) == 1,
    ]) }}
</div>

<div class="form-group">
    {{ Field::checkbox(__('Allow User to Switch Currency'), 'ecomm_allow_currency_switcher', [
        'checked' => get_config('ecomm_allow_currency_switcher', 1) == 1,
    ]) }}
</div>

<div class="form-group">
    {{ Field::select(__('Force Checkout Currency'), 'ecomm_force_checkout_currency', [
        'value' => get_config('ecomm_force_checkout_currency'),
        'options' => getAvailableCurrencyCodes()
    ]) }}
</div>

<div class="form-group">
    {{ Field::select(__('Exchange Rate API'), 'ecomm_exchange_rate_api', [
        'value' => get_config('ecomm_exchange_rate_api'),
        'options' => [
            '' => __('None'),
            'api_layer' => 'API Layer',
            'open_exchange' => 'Open Exchange Rates'
        ]
    ]) }}
    
    {{ Field::text(__('Exchange Rate API Key'), 'ecomm_exchange_rate_api_key', [
        'value' => get_config('ecomm_exchange_rate_api_key')
    ]) }}

    {{ Field::text(__('Auto Update Exchange Rates?'), 'ecomm_auto_update_exchange', [
        'value' => get_config('ecomm_auto_update_exchange', 0)
    ]) }}
</div>

<!-- Include the dynamic currency table -->
@include('ecomm::backend.setting.components.setting.currencies_list')