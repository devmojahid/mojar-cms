<?php

namespace Juzaweb\CMS\Support;

use Juzaweb\CMS\Models\PaymentMethod;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use InvalidArgumentException;

class PaymentMethodManager
{
    protected array $drivers = [];

    /**
     * Register a new payment driver.
     */
    public function extend(string $type, \Closure $resolver): void
    {
        $this->drivers[$type] = $resolver;
    }

    /**
     * Make an instance of the specified driver by PaymentMethod model.
     */
    public function make(PaymentMethod $paymentMethod): PaymentMethodInterface
    {
        $type = $paymentMethod->type;

        if (!isset($this->drivers[$type])) {
            throw new InvalidArgumentException("Payment driver [{$type}] not registered.");
        }

        return call_user_func($this->drivers[$type], $paymentMethod);
    }
}