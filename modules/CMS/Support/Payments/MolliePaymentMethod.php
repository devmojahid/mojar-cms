<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Omnipay\Omnipay;
use Omnipay\Common\Exception\InvalidRequestException;
use Exception;

class MolliePaymentMethod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        // 1) Setup Omnipay for Mollie
        $gateway = Omnipay::create('Mollie');
        
        // 2) Get your Mollie apiKey
        $data = json_decode($this->paymentMethod->data, true) ?: [];
        $apiKey = $data['apiKey'] ?? null;
        
        if (!$apiKey) {
            $this->setSuccessful(false);
            $this->setMessage('Mollie API key missing.');
            $this->status = PaymentStatus::FAILED;
            return $this;
        }

        $gateway->initialize(['apiKey' => $apiKey]);

        try {
            // 3) Create the purchase
            $response = $gateway->purchase([
                'amount'      => $params['amount'] ?? 0,
                'currency'    => $params['currency'] ?? 'EUR',
                'description' => $params['description'] ?? 'Order Payment',
                'returnUrl'   => $params['returnUrl'] ?? '',
            ])->send();

            if ($response->isRedirect()) {
                $this->setRedirect(true);
                $this->setRedirectURL($response->getRedirectUrl());
                $this->setSuccessful(false);
                $this->status = PaymentStatus::PENDING;
            } elseif ($response->isSuccessful()) {
                // Payment done
                $this->setRedirect(false);
                $this->setSuccessful(true);
                $this->status = PaymentStatus::COMPLETED;
            } else {
                $this->setRedirect(false);
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $this->setMessage($response->getMessage());
            }
        } catch (InvalidRequestException $e) {
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        } catch (Exception $e) {
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    public function completed(array $params): PaymentMethodInterface
    {
        // 4) On return from Mollie
        $gateway = Omnipay::create('Mollie');
        $data = json_decode($this->paymentMethod->data, true) ?: [];
        $apiKey = $data['apiKey'] ?? null;
        $gateway->initialize(['apiKey' => $apiKey]);

        try {
            // Typically, pass a 'transactionReference'
            // or 'transactionId' from callback
            $response = $gateway->completePurchase([
                'transactionReference' => $params['paymentId'] ?? null,
            ])->send();

            if ($response->isSuccessful()) {
                $this->setSuccessful(true);
                $this->status = PaymentStatus::COMPLETED;
            } else {
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $this->setMessage($response->getMessage());
            }
        } catch (Exception $e) {
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    protected function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }
}

// composer require omnipay/mollie

