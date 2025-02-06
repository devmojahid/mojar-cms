<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;

class Cod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        $this->successful = true;
        return $this;
    }

    public function completed(array $params): PaymentMethodInterface
    {
        $this->successful = true;
        return $this;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    public function getMessage(): string
    {
        return __('Your order has been placed successfully. Please pay on delivery.');
    }
}