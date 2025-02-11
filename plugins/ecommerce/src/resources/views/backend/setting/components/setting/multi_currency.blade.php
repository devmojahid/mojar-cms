<h5>{{ __('Multi‐Currency Settings') }}</h5>

<div class="form-group">
    {{ Field::text(__('Enable Multi‐Currency'), 'ecom_enable_multi_currency', [
        'value' => get_config('ecom_enable_multi_currency', 0),
        'type' => 'switch',
    ]) }}
</div>

<div class="form-group">
    {{ Field::text(__('Auto Detect Currency by IP'), 'ecom_auto_detect_currency', [
        'value' => get_config('ecom_auto_detect_currency', 0),
        'type' => 'switch',
    ]) }}
</div>

<div class="form-group">
    {{ Field::text(__('Allow User to Switch Currency'), 'ecom_allow_currency_switcher', [
        'value' => get_config('ecom_allow_currency_switcher', 1),
        'type' => 'switch',
    ]) }}
</div>

<div class="form-group">
    {{ Field::select(__('Force Checkout Currency'), 'ecom_force_checkout_currency', [
        'value' => get_config('ecom_force_checkout_currency'),
        // 'options' => getAvailableCurrencyCodes() // we'll define a helper
    ]) }}
</div>

{{-- A dynamic table or resource form to manage each currency code, symbol, rate --}}
@include('ecomm::backend.setting.components.setting.currencies_list')

{{-- Exchange rate API settings --}}
<div class="form-group">
    {{ Field::select(__('Exchange Rate API'), 'ecom_exchange_rate_api', [
        'value' => get_config('ecom_exchange_rate_api'),
        'options' => [
            '' => __('None'),
            'api_layer' => 'API Layer',
            'open_exchange' => 'Open Exchange Rates',
            // ...
        ]
    ]) }}

    {{ Field::text(__('Exchange Rate API Key'), 'ecom_exchange_rate_api_key', [
        'value' => get_config('ecom_exchange_rate_api_key'),
    ]) }}

    {{ Field::text(__('Auto Update Exchange Rates?'), 'ecom_auto_update_exchange', [
        'value' => get_config('ecom_auto_update_exchange', 0),
        'type' => 'switch',
    ]) }}
</div>