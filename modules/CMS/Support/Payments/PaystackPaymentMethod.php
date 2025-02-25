<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Omnipay\Omnipay;
use Omnipay\Common\Exception\InvalidRequestException;
use Exception;

class PaystackPaymentMethod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        $gateway = Omnipay::create('Paystack');
        
        $data = json_decode($this->paymentMethod->data, true) ?: [];
        $secretKey = $data['secretKey'] ?? null;
        if (!$secretKey) {
            $this->setSuccessful(false);
            $this->setMessage('Paystack secret key is missing.');
            $this->status = PaymentStatus::FAILED;
            return $this;
        }

        $gateway->initialize(['secretKey' => $secretKey]);

        try {
            // Paystack requires email param in addition to amount/currency
            $response = $gateway->purchase([
                'amount'        => $params['amount'] ?? 0,
                'currency'      => $params['currency'] ?? 'NGN',
                'email'         => $params['email'] ?? 'user@example.com',
                'reference'     => $params['reference'] ?? uniqid('paystack_'),
                'callbackUrl'   => $params['returnUrl'] ?? '',
            ])->send();

            if ($response->isRedirect()) {
                $this->setRedirect(true);
                $this->setRedirectURL($response->getRedirectUrl());
                $this->setSuccessful(false);
                $this->status = PaymentStatus::PENDING;
            } elseif ($response->isSuccessful()) {
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
        $gateway = Omnipay::create('Paystack');
        $data = json_decode($this->paymentMethod->data, true) ?: [];
        $secretKey = $data['secretKey'] ?? null;

        $gateway->initialize(['secretKey' => $secretKey]);

        try {
            // Usually, "transactionReference" is in your callback query
            // e.g. ?trxref=12345&reference=12345
            $reference = $params['reference'] ?? $params['trxref'] ?? null;

            $response = $gateway->verify([
                'transactionReference' => $reference,
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

// composer require phemellc/omnipay-paystack
