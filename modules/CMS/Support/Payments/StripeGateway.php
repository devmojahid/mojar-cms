<?php 

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Omnipay\Omnipay;
use Omnipay\Common\GatewayInterface;

class StripeGateway extends PaymentMethodAbstract
{
    public function purchase(array $params): PaymentMethodInterface
    {
        $gateway = $this->getGateway();
        $response = $gateway->purchase($params)->send();

        $this->setRedirect($response->isRedirect());
        $this->setRedirectURL($response->getRedirectUrl() ?? '');
        $this->setSuccessful($response->isSuccessful());

        return $this;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    public function completed(array $params): PaymentMethodInterface

    {
        $gateway = $this->getGateway();
        $response = $gateway->completePurchase($params)->send();

        $this->setSuccessful($response->isSuccessful());

        return $this;
    }

    private function getGateway(): GatewayInterface
    {
        $gateway = Omnipay::create('Stripe');
        $gateway->initialize([
            'apiKey'   => $this->paymentMethod->data['secret_key'] ?? '',
            'testMode' => ($this->paymentMethod->data['mode'] ?? 'test') === 'test',
        ]);

        return $gateway;
    }
}
