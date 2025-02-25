<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Omnipay\Omnipay; // Make sure "anoopambal/omnipay-razorpay" is installed
use Omnipay\Common\Exception\InvalidRequestException;
use Exception;

class RazorpayPaymentMethod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        // 1) Initialize Omnipay gateway
        $gateway = Omnipay::create('Razorpay');
        
        // 2) Get credentials from $this->paymentMethod->data
        $data = json_decode($this->paymentMethod->data, true) ?: [];
        $apiKey    = $data['apiKey']    ?? null;
        $apiSecret = $data['apiSecret'] ?? null;
        
        if (!$apiKey || !$apiSecret) {
            $this->setSuccessful(false);
            $this->setMessage('Missing Razorpay API credentials.');
            $this->status = PaymentStatus::FAILED;
            return $this;
        }
        
        $gateway->initialize([
            'keyId'     => $apiKey,
            'keySecret' => $apiSecret,
        ]);

        try {
            // 3) Prepare purchase data
            $response = $gateway->purchase([
                'amount'      => $params['amount'] ?? 0,
                'currency'    => $params['currency'] ?? 'INR',
                'description' => $params['description'] ?? 'Order Payment',
                // Razorpay often uses a "receipt" param, optionally set:
                'receipt'     => $params['receipt'] ?? 'Order_123',
                
                // For offsite or further steps
                'returnUrl'   => $params['returnUrl'] ?? '',
            ])->send();

            if ($response->isRedirect()) {
                $this->setRedirect(true);
                $this->setRedirectURL($response->getRedirectUrl());
                $this->setSuccessful(false);
                $this->status = PaymentStatus::PENDING;
            } elseif ($response->isSuccessful()) {
                // Payment captured instantly
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
        // Typically, if Razorpay requires offsite, they'd redirect back
        // Then you confirm/capture payment here if needed
        $data = json_decode($this->paymentMethod->data, true) ?: [];
        $apiKey    = $data['apiKey']    ?? null;
        $apiSecret = $data['apiSecret'] ?? null;

        $gateway = Omnipay::create('Razorpay');
        $gateway->initialize([
            'keyId'     => $apiKey,
            'keySecret' => $apiSecret,
        ]);

        try {
            // If we need to confirm or capture:
            //  $response = $gateway->completePurchase([...])->send();
            // Usually you pass 'paymentId' or 'razorpay_payment_id' from query
            $response = $gateway->completePurchase($params)->send();

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

// composer require anoopambal/omnipay-razorpay
