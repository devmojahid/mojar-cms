<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojahid\Ecommerce\Contracts\Payment;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * @see \Mojahid\Ecommerce\Supports\Payment\PaymentMethodInterface
 */
interface PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface;

    public function completed(array $params): PaymentMethodInterface;

    public function isSuccessful(): bool;

    public function isRedirect(): bool;

    public function getRedirectURL(): ?string;

    public function getMessage(): string;
}
