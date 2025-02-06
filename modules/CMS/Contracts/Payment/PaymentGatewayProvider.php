<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     Mojahid
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Contracts\Payment;

interface PaymentGatewayProvider
{
    public function register(): void;
    public function getIdentifier(): string;
    public function getName(): string;
    public function getDescription(): string;
    public function getConfigFields(): array;
}
