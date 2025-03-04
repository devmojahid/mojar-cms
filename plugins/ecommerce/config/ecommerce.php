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
        'razorpay' => 'Razorpay',
        'stripe' => 'Stripe',
        'bank_transfer' => 'Bank Transfer',
        'paystack' => 'Paystack',
        'flutterwave' => 'Flutterwave',
        'mollie' => 'Mollie',
        'square' => 'Square',
    ],
];
