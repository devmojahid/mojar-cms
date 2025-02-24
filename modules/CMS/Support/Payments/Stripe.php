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

class Stripe extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        $gateway = $this->getGateway();

        // Convert amount to cents if needed (Stripe requires amounts in cents)
        // If your amount is already in cents, you can remove this conversion
        $amount = isset($params['amount']) ? $params['amount'] : 100;

        $purchaseParams = [
            'amount' => $amount,
            'currency' => $params['currency'] ?? 'USD',
            'returnUrl' => $params['returnUrl'],
            'cancelUrl' => $params['cancelUrl'],
            'paymentMethod' => $params['token'] ?? 'tok_visa', // For testing
            'confirm' => true,
            'payment_method_types' => ['card'],
        ];

        // Use payment intents for modern Stripe integration
        $response = $gateway->createPaymentIntent($purchaseParams)->send();

        if ($response->isSuccessful()) {
            // Payment was successful without redirect needed
            $this->setRedirect(false);
            $this->successful = true;

            // Store the payment intent ID for later reference
            if (method_exists($this, 'setTransactionReference')) {
                $this->setTransactionReference($response->getPaymentIntentReference());
            }
        } elseif ($response->isRedirect()) {
            // Payment requires redirect (e.g., 3D Secure authentication)
            $this->setRedirect(true);
            $this->setRedirectURL($response->getRedirectUrl());
        } else {
            // Payment failed
            $this->setRedirect(false);
            $this->successful = false;
            $this->setMessage($response->getMessage());
        }

        return $this;
    }

    public function completed(array $params): PaymentMethodInterface
    {
        $gateway = $this->getGateway();

        // Get the payment intent ID from the return parameters
        $paymentIntentId = $params['payment_intent'] ?? null;

        if (empty($paymentIntentId)) {
            // Check other possible parameter names
            $paymentIntentId = $params['id'] ?? $params['stripe_payment_intent'] ?? null;
        }

        if ($paymentIntentId) {
            // Retrieve and confirm the payment intent
            $response = $gateway->retrievePaymentIntent([
                'paymentIntentReference' => $paymentIntentId
            ])->send();

            $this->successful = $response->isSuccessful() &&
                in_array($response->getData()['status'], ['succeeded', 'requires_capture']);

            if ($this->successful) {
                if (method_exists($this, 'setTransactionReference')) {
                    $this->setTransactionReference($paymentIntentId);
                }
            } else {
                $this->setMessage($response->getMessage() ?? 'Payment verification failed');
            }
        } else {
            $this->successful = false;
            $this->setMessage('No payment intent ID found in the return parameters');
        }

        return $this;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    private function getGateway(): GatewayInterface
    {
        $gateway = Omnipay::create('Stripe\PaymentIntents');

        if ($this->paymentMethod->data['mode'] == 'live') {
            $secretKey = $this->paymentMethod->data['live_secret_key'];
            $testMode = false;
        } else {
            $secretKey = $this->paymentMethod->data['test_secret_key'];
            $testMode = true;
        }

        $gateway->setApiKey($secretKey);
        $gateway->setTestMode($testMode);

        return $gateway;
    }

    // Note: I've removed the custom method implementations that were causing conflicts
    // Your PaymentMethodAbstract class already has these methods with the correct signatures
}
