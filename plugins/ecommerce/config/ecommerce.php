<?php

return [
    /**
     * Cart Helper class support
     */
    'cart' => \Mojahid\Ecommerce\Supports\DBCart::class,

    /**
     * Payment method supported
     */
    'payment_methods' => [
        'cod' => 'Cash on delivery',
        'paypal' => 'Paypal',
        'custom' => 'Custom',
    ],
];
