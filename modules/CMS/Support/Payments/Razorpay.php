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

class Razorpay extends PaymentMethodAbstract
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
                'description' => 'Order Payment #' . ($params['orderId'] ?? time()),
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
                'razorpay_payment_id' => $params['razorpay_payment_id'],
                'razorpay_order_id' => $params['razorpay_order_id'],
                'razorpay_signature' => $params['razorpay_signature']
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
        $gateway = Omnipay::create('Razorpay');

        $gateway->initialize([
            'key' => $this->paymentMethod->data['mode'] === 'live'
                ? $this->paymentMethod->data['live_key_id']
                : $this->paymentMethod->data['test_key_id'],
            'secret' => $this->paymentMethod->data['mode'] === 'live'
                ? $this->paymentMethod->data['live_key_secret']
                : $this->paymentMethod->data['test_key_secret'],
            'testMode' => $this->paymentMethod->data['mode'] !== 'live'
        ]);

        return $gateway;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }
}
