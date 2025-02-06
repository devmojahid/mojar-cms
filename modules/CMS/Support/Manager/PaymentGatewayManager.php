<?php

namespace Juzaweb\CMS\Support\Manager;

use Juzaweb\CMS\Contracts\Payment\PaymentGatewayProvider;
use Illuminate\Support\Manager;

class PaymentGatewayManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return 'paypal';
    }

    protected array $providers = [];


    public function registerProvider(PaymentGatewayProvider $provider): void
    {
        $this->providers[$provider->getIdentifier()] = $provider;
    }

    public function getProviders(): array
    {
        return $this->providers;
    }

    public function getProvider(string $identifier): ?PaymentGatewayProvider
    {
        return $this->providers[$identifier] ?? null;
    }
}