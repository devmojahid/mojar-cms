<?php

namespace Mojahid\Ecommerce\Supports;

use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Supports\Payments\Paypal;
use Mojahid\Ecommerce\Supports\Payments\Cod;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;
use Mojahid\Ecommerce\Supports\Payments\Stripe;
use Mojahid\Ecommerce\Supports\Payments\Mollie;

class Payment
{
    public function make(PaymentMethod $paymentMethod): PaymentMethodInterface
    {
        return match ($paymentMethod->type) {
            'paypal' => new Paypal($paymentMethod),
            'cod' => new Cod($paymentMethod),
            'stripe' => new Stripe($paymentMethod),
            'mollie' => new Mollie($paymentMethod),
            default => new Cod($paymentMethod),
        };
    }

    public function purchase(PaymentMethod $paymentMethod, array $params = []): PaymentMethodInterface
    {
        return $this->make($paymentMethod)->purchase($params);
    }

    public function completed(PaymentMethod $paymentMethod, array $params): PaymentMethodInterface
    {
        return $this->make($paymentMethod)->completed($params);
    }
}
