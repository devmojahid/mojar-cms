<?php

use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartItemCollectionResource;
use Mojahid\Ecommerce\Http\Resources\PaymentMethodCollectionResource;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Contracts\CartContract;

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
