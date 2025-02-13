<?php

use Juzaweb\CMS\Http\Resources\PaymentMethodCollectionResource;
use Juzaweb\CMS\Models\PaymentMethod;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartItemCollectionResource;

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

        return '$'.$price;
    }
}
