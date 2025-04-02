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
        'options' => getAvailableCurrencyCodes(),
    ]) }}
</div>

<div class="form-group">
    {{ Field::select(__('Exchange Rate API'), 'ecomm_exchange_rate_api', [
        'value' => get_config('ecomm_exchange_rate_api'),
        'options' => [
            '' => __('None'),
            'api_layer' => 'API Layer',
            'open_exchange' => 'Open Exchange Rates',
        ],
    ]) }}

    {{ Field::text(__('Exchange Rate API Key'), 'ecomm_exchange_rate_api_key', [
        'value' => get_config('ecomm_exchange_rate_api_key'),
    ]) }}

    {{ Field::text(__('Auto Update Exchange Rates?'), 'ecomm_auto_update_exchange', [
        'value' => get_config('ecomm_auto_update_exchange', 0),
    ]) }}
</div>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Multi-Currency Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure multi-currency options for your store.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Multi-Currency'), '_enable_multi_currency', [
                        'value' => get_config('_enable_multi_currency', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small
                        class="form-text text-muted">{{ __('Allow customers to switch between different currencies.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Auto-Update Exchange Rates'), '_auto_update_exchange_rates', [
                        'value' => get_config('_auto_update_exchange_rates', 0),
                        'class' => 'form-check-input',
                    ]) }}
                    <small class="form-text text-muted">{{ __('Automatically update exchange rates daily.') }}</small>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                {{ Field::text(__('Exchange Rate API Key'), '_exchange_rate_api_key', [
                    'value' => get_config('_exchange_rate_api_key'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('API key for automatic exchange rate updates.') }}</small>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Available Currencies') }}</h5>
        <div class="card-subtitle">
            {{ __('Select which currencies customers can use on your store.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('USD - US Dollar'), '_currency_usd', [
                        'value' => get_config('_currency_usd', 1),
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('EUR - Euro'), '_currency_eur', [
                        'value' => get_config('_currency_eur', 0),
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('GBP - British Pound'), '_currency_gbp', [
                        'value' => get_config('_currency_gbp', 0),
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('JPY - Japanese Yen'), '_currency_jpy', [
                        'value' => get_config('_currency_jpy', 0),
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('CAD - Canadian Dollar'), '_currency_cad', [
                        'value' => get_config('_currency_cad', 0),
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('AUD - Australian Dollar'), '_currency_aud', [
                        'value' => get_config('_currency_aud', 0),
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title">{{ __('Currency Exchange Rates') }}</h5>
        <div class="card-subtitle">
            {{ __('Set exchange rates manually or use auto-update feature.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            {{ __('Base currency is') }} <strong>{{ get_config('_currency', 'USD') }}</strong>.
            {{ __('All exchange rates are relative to this base.') }}
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text(__('EUR Exchange Rate'), '_exchange_rate_eur', [
                    'value' => get_config('_exchange_rate_eur', '0.85'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Exchange rate for Euro.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text(__('GBP Exchange Rate'), '_exchange_rate_gbp', [
                    'value' => get_config('_exchange_rate_gbp', '0.75'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Exchange rate for British Pound.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text(__('JPY Exchange Rate'), '_exchange_rate_jpy', [
                    'value' => get_config('_exchange_rate_jpy', '110'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Exchange rate for Japanese Yen.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text(__('CAD Exchange Rate'), '_exchange_rate_cad', [
                    'value' => get_config('_exchange_rate_cad', '1.25'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Exchange rate for Canadian Dollar.') }}</small>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                {{ Field::text(__('AUD Exchange Rate'), '_exchange_rate_aud', [
                    'value' => get_config('_exchange_rate_aud', '1.35'),
                    'class' => 'form-control',
                ]) }}
                <small class="form-text text-muted">{{ __('Exchange rate for Australian Dollar.') }}</small>
            </div>
            <div class="col-md-6">
                {{ Field::text(__('Last Updated'), '_exchange_rate_last_updated', [
                    'value' => get_config('_exchange_rate_last_updated', date('Y-m-d')),
                    'class' => 'form-control',
                    'disabled' => 'disabled',
                ]) }}
                <small class="form-text text-muted">{{ __('Date of last exchange rate update.') }}</small>
            </div>
        </div>
    </div>
</div>

<!-- Include the dynamic currency table -->
@include('ecomm::backend.setting.components.setting.currencies_list')
