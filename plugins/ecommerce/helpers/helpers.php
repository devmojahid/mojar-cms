<?php

use Illuminate\Support\Facades\Log;
use Juzaweb\CMS\Http\Resources\PaymentMethodCollectionResource;
use Juzaweb\CMS\Models\PaymentMethod;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartItemCollectionResource;
use Mojahid\Ecommerce\Models\Currency;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;
if (!function_exists('ecom_get_cart')) {
    function ecom_get_cart(): array
    {
        /**
         * @var CartContract $cart
         */
        $cart = app(CartManagerContract::class)->find();

        return [
            'code' => $cart->getCode(),
            'items' => ecom_get_cart_items($cart),
        ];
    }
}

if (!function_exists('ecom_get_cart_items')) {
    function ecom_get_cart_items(CartContract $cart = null): array
    {
        $cart = $cart ?: app(CartContract::class);

        $items = $cart->getCollectionItems();

        return (new CartItemCollectionResource($items))
            ->toArray(request());
    }
}

if (!function_exists('ecom_get_payment_methods')) {
    function ecom_get_payment_methods(): array
    {
        $methods = PaymentMethod::active()->get();

        return (new PaymentMethodCollectionResource($methods))
            ->toArray(request());
    }
}

if (!function_exists('ecom_price_with_unit')) {
    function ecom_price_with_unit(?float $price): ?string
    {
        if (is_null($price)) {
            return null;
        }

        $manager = app(CurrencyManager::class);

        $converted = $manager->convertPrice($price);
        $formatted = $manager->formatPrice($converted);

        return '$'.$price;
    }
}

if (!function_exists('ecom_price_with_currency')) {
    function ecom_price_with_currency(?float $price): ?string
    {
        if (is_null($price)) {
            return null;
        }

        $manager = app(CurrencyManager::class);

        $converted = $manager->convertPrice($price);
        $formatted = $manager->formatPrice($converted);

        return $formatted;
    }
}


if (!function_exists('getAvailableCurrencyCodes')) {
    /**
     * Get list of available currency codes from database
     *
     * @return array
     */
    function getAvailableCurrencyCodes(): array
    {
        try {
            return Currency::query()
                ->where('is_active', true)
                ->pluck('name', 'code')
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error fetching currency codes: ' . $e->getMessage());
            return ['USD' => 'US Dollar (USD)']; // Fallback to USD if error
        }
    }
}


// {% set cart = ecom_get_cart() %}
// {{ ecom_price_with_unit(120) }}

// Cart Page
// {% for item in cart.items %}
//   <tr>
//     <td>{{ item.title }}</td>
//     <td>{{ ecom_price_with_unit(item.price_without_unit) }}</td>
//     ...
//   </tr>
// {% endfor %}

// Example: If your “CartItemResource” returns “line_price_without_unit,” you can do
// {{ ecom_price_with_unit(item.line_price_without_unit) }}

// Checkout Page
// <p>Total: {{ ecom_price_with_unit(cart.total_price) }}</p>
