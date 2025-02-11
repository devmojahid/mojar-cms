<?php

namespace Mojahid\Ecommerce\Supports\Manager;

use Mojahid\Ecommerce\Models\Currency;

class CurrencyManager
{
    protected ?string $currentCurrencyCode = null; // e.g. from session

    public function getCurrentCurrencyCode(): string
    {
        // 1) if user selected currency in session, return it
        // 2) if auto detect is on, attempt IP geolocation or accept-languages
        // 3) else fallback to default currency
        if ($this->currentCurrencyCode) {
            return $this->currentCurrencyCode;
        }

        $this->currentCurrencyCode = Currency::where('is_default', true)->first()->code;
        return $this->currentCurrencyCode;
    }

    public function convertPrice(float $basePrice, ?string $toCurrency = null): float
    {
        if (!$toCurrency) {
            $toCurrency = $this->getCurrentCurrencyCode();
        }
        // find the currency row in DB
        $currency = Currency::where('currency_code', $toCurrency)->first();
        if (!$currency || !$currency->is_enabled) {
            // fallback
            $currency = Currency::where('is_default', true)->first();
        }

        // multiply by exchange_rate
        return $basePrice * ($currency->exchange_rate ?? 1.0);
    }

    public function formatPrice(float $amount, ?string $currencyCode = null): string
    {
        // get symbol, custom format
        $currencyCode = $currencyCode ?: $this->getCurrentCurrencyCode();
        $currency = Currency::where('currency_code', $currencyCode)->first();
        if (!$currency) {
            // fallback
        }

        $symbol = $currency->symbol ?? '$';
        // If there's a custom format, e.g. {symbol}{amount}
        return $symbol . number_format($amount, 2);
    }

    public function updateExchangeRatesAutomatically()
    {
        // check config('ecom_auto_update_exchange')
        // pick the API from config('ecom_exchange_rate_api')
        // fetch new rates, update DB for each currency
        // handle errors robustly (log them, etc.)

        if (!get_config('ecom_auto_update_exchange', false)) {
            return;
        }


        $api = get_config('ecom_exchange_rate_api');
        $apiKey = get_config('ecom_exchange_rate_api_key');

        if ($api == 'api_layer') {
            $this->updateViaApiLayer($apiKey);
        } elseif ($api == 'open_exchange') {
            $this->updateViaOpenExchange($apiKey);
        } else {
            // no API
        }
    }

    private function updateViaApiLayer($apiKey)
    {
        // call https://apilayer.com/ ...
        // parse JSON, update each currency's exchange_rate
    }

    private function updateViaOpenExchange($apiKey)
    {
        // ...
    }
}
