<?php

namespace Juzaweb\CMS\Support;

use Juzaweb\CMS\Models\PaymentMethod;
use Juzaweb\CMS\Support\Payments\Paypal;
use Juzaweb\CMS\Support\Payments\Cod;   
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;

class Payment
{
    public function make(PaymentMethod $paymentMethod): PaymentMethodInterface
    {
        return match ($paymentMethod->type) {
            'paypal' => new Paypal($paymentMethod),
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
