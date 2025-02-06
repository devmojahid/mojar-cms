<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Support\Payments\Base;

use Juzaweb\CMS\Contracts\Payment\PaymentGatewayProvider;

abstract class BaseGatewayProvider implements PaymentGatewayProvider
{
    protected array $configFields = [];
    protected string $identifier;
    protected string $name;
    protected string $description;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getConfigFields(): array
    {
        return $this->configFields;
    }
}