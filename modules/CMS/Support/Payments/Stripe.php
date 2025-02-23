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
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;

class Stripe extends PaymentMethodAbstract
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $gateway = $this->getGateway();

            $response = $gateway->purchase([
                'amount' => $params['amount'],
                'currency' => $params['currency'],
                'returnUrl' => $params['returnUrl'],
                'cancelUrl' => $params['cancelUrl'],
                'paymentMethod' => 'card',
                'confirm' => true,
            ])->send();

            if ($response->isRedirect()) {
                $this->setRedirect(true);
                $this->setRedirectURL($response->getRedirectResponse()->getTargetUrl());
                $this->setSuccessful(true);
            } else {
                $this->setRedirect(false);
                $this->setSuccessful($response->isSuccessful());
                $this->setMessage($response->getMessage());
            }
        } catch (\Exception $e) {
            $this->setSuccessful(false);
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    public function completed(array $params): PaymentMethodInterface
    {
        try {
            $gateway = $this->getGateway();

            $response = $gateway->completePurchase([
                'paymentIntent' => $params['payment_intent'],
            ])->send();

            $this->setSuccessful($response->isSuccessful());
            $this->setMessage($response->getMessage());
        } catch (\Exception $e) {
            $this->setSuccessful(false);
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    private function getGateway(): GatewayInterface
    {
        $gateway = Omnipay::create('Stripe');

        $secretKey = $this->paymentMethod->data['mode'] === 'live'
            ? $this->paymentMethod->data['live_secret_key']
            : $this->paymentMethod->data['test_secret_key'];

        $gateway->setApiKey($secretKey);
        $gateway->setTestMode($this->paymentMethod->data['mode'] !== 'live');

        return $gateway;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }
}
