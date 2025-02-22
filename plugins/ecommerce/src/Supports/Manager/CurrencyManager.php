<?php

namespace Mojahid\Ecommerce\Supports\Manager;

use Illuminate\Support\Facades\Session;
use Mojahid\Ecommerce\Models\Currency;

class CurrencyManager
{
    protected ?string $currentCurrencyCode = null;

    /**
     * Returns the user's current currency code, from session or fallback to default.
     */
    public function getCurrentCurrencyCode(): string
    {
        // If already set in memory
        if ($this->currentCurrencyCode) {
            return $this->currentCurrencyCode;
        }

        // If in session
        $sessionCode = Session::get('jw_current_currency');
        if ($sessionCode) {
            $this->currentCurrencyCode = $sessionCode;
            return $this->currentCurrencyCode;
        }

        // Optionally auto detect by IP if config says so
        // ecom_auto_detect_currency => do geolocation => set $this->currentCurrencyCode

        // fallback to default
        $defaultCurrency = Currency::default()->first();
        $this->currentCurrencyCode = $defaultCurrency 
            ? $defaultCurrency->currency_code 
            : 'USD';

        return $this->currentCurrencyCode;
    }

    /**
     * Allows user or system to override the currency code (for currency switchers).
     */
    public function setCurrentCurrencyCode(string $code): void
    {
        // validate if code is enabled
        $currency = Currency::where('currency_code', $code)
            ->where('is_enabled', true)
            ->first();

        if ($currency) {
            $this->currentCurrencyCode = $code;
            Session::put('jw_current_currency', $code);
        }
    }

    /**
     * Convert a base price to the selected currency.
     */
    public function convertPrice(float $basePrice, ?string $toCurrency = null): float
    {
        $toCurrency = $toCurrency ?: $this->getCurrentCurrencyCode();

        $currency = Currency::where('currency_code', $toCurrency)
            ->where('is_enabled', true)
            ->first();

        if (!$currency) {
            // fallback
            $currency = Currency::default()->first();
        }
        $rate = $currency->exchange_rate ?? 1.0;

        return $basePrice * $rate;
    }

    /**
     * Format an amount with symbol, decimal places, etc.
     */
    public function formatPrice(float $amount, ?string $currencyCode = null): string
    {
        $currencyCode = $currencyCode ?: $this->getCurrentCurrencyCode();
        $currency = Currency::where('currency_code', $currencyCode)->first();

        if (!$currency) {
            // fallback
            $currency = Currency::default()->first();
            if (!$currency) {
                // fallback usage
                return '$' . number_format($amount, 2);
            }
        }

        $symbol    = $currency->symbol ?: '$';
        $decPlace  = $currency->decimal_place ?? 2;
        $decSep    = $currency->decimal_separator ?? '.';
        $thouSep   = $currency->thousand_separator ?? ',';

        $formattedValue = number_format($amount, $decPlace, $decSep, $thouSep);

        // Check custom format
        if (!empty($currency->custom_price_format)) {
            // e.g. placeholders: {symbol}, {amount}, {code}
            return str_replace(
                ['{symbol}', '{amount}', '{code}'],
                [$symbol, $formattedValue, $currency->currency_code],
                $currency->custom_price_format
            );
        }

        // else symbol_position logic
        if ($currency->symbol_position === 'after') {
            return $formattedValue . ' ' . $symbol;
        }
        // default is 'before'
        return $symbol . $formattedValue;
    }

    /**
     * If store wants to force final checkout in a single currency, e.g. default.
     */
    public function getCheckoutCurrencyCode(): string
    {
        $force = get_config('ecom_force_checkout_currency');
        if (!empty($force)) {
            return $force;
        }
        return $this->getCurrentCurrencyCode();
    }

    /**
     * Cron or schedule for auto updating exchange rates from an external API.
     */
    public function updateExchangeRatesAutomatically(): void
    {
        if (!get_config('ecom_auto_update_exchange', false)) {
            return;
        }

        $api = get_config('ecom_exchange_rate_api');
        $apiKey = get_config('ecom_exchange_rate_api_key');

        if ($api === 'api_layer') {
            $this->updateViaApiLayer($apiKey);
        } elseif ($api === 'open_exchange') {
            $this->updateViaOpenExchange($apiKey);
        }
        // else no API
    }

    private function updateViaApiLayer(?string $apiKey = null): void
    {
        // Example pseudo-code:
        // 1) call https://apilayer.com/fixer or something with $apiKey
        // 2) parse JSON, loop each local currency, set $model->exchange_rate
        // 3) handle errors robustly
    }

    private function updateViaOpenExchange(?string $apiKey = null): void
    {
        // Example pseudo-code:
        // 1) call openexchangerates.org with $apiKey
        // 2) parse, update each currency
    }
}

