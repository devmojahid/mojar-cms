<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use GuzzleHttp\Client; // or MyPay official SDK
use Exception;

class MyPayPaymentMethod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    /**
     * Step 1: "purchase" – create a transaction and possibly redirect the user
     *
     * @param  array  $params  [amount, currency, description, returnUrl, etc.]
     * @return PaymentMethodInterface
     */
    public function purchase(array $params): PaymentMethodInterface
    {
        // 1) Load config from DB
        $gatewayData = json_decode($this->paymentMethod->data, true) ?: [];
        $apiKey = $gatewayData['apiKey'] ?? null;
        $apiSecret = $gatewayData['apiSecret'] ?? null;

        if (!$apiKey || !$apiSecret) {
            $this->setSuccessful(false);
            $this->setMessage('MyPay credentials missing.');
            $this->status = PaymentStatus::FAILED;
            return $this;
        }

        // 2) Build or load an HTTP client / official SDK
        $client = new Client([
            'base_uri' => 'https://api.mypay.com/v1/',
            'headers'  => ['Authorization' => "Bearer {$apiKey}"],
        ]);

        try {
            // 3) Call create-transaction endpoint
            $body = [
                'amount'      => $params['amount'] ?? 0,
                'currency'    => $params['currency'] ?? 'USD',
                'description' => $params['description'] ?? 'MyPay Order',
                'returnUrl'   => $params['returnUrl'] ?? '', // For redirection
            ];

            $response = $client->post('create-transaction', [
                'json' => $body,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (($data['status'] ?? '') === 'success') {
                // If MyPay says we must redirect user to HPP
                if (!empty($data['redirect_url'])) {
                    $this->setRedirect(true);
                    $this->setRedirectURL($data['redirect_url']);
                    $this->setSuccessful(false);
                    $this->status = PaymentStatus::PENDING;
                } else {
                    // Possibly no redirect needed => paid instantly?
                    $this->setRedirect(false);
                    $this->setSuccessful(true);
                    $this->status = PaymentStatus::COMPLETED;
                }
                // Optionally store transaction_id in $this->message or local property
                // But typically your main system will store it in "orders" table
            } else {
                // MyPay returned an error
                $this->setRedirect(false);
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $errorMsg = $data['message'] ?? 'Unknown error from MyPay';
                $this->setMessage($errorMsg);
            }
        } catch (Exception $e) {
            $this->setRedirect(false);
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    /**
     * Step 2: "completed" – user returned from MyPay or gateway sends callback
     *
     * @param  array  $params  Usually includes transaction_id, status, etc.
     * @return PaymentMethodInterface
     */
    public function completed(array $params): PaymentMethodInterface
    {
        $gatewayData = json_decode($this->paymentMethod->data, true) ?: [];
        $apiKey = $gatewayData['apiKey'] ?? null;

        $transactionId = $params['transaction_id'] ?? null;
        $status = $params['status'] ?? null;

        if (!$transactionId) {
            // no transaction to verify
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage('transaction_id missing in callback.');
            return $this;
        }

        // We can re-verify by calling MyPay's "transaction detail" API
        // Or if we trust the callback, we can just interpret status

        $client = new Client([
            'base_uri' => 'https://api.mypay.com/v1/',
            'headers'  => ['Authorization' => "Bearer {$apiKey}"],
        ]);

        try {
            $verifyResponse = $client->get("transaction/{$transactionId}");
            $verifyData = json_decode($verifyResponse->getBody()->getContents(), true);

            if (($verifyData['status'] ?? '') === 'completed') {
                // Payment is done
                $this->setSuccessful(true);
                $this->status = PaymentStatus::COMPLETED;
            } else {
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $msg = $verifyData['message'] ?? 'Payment not completed.';
                $this->setMessage($msg);
            }
        } catch (Exception $e) {
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    /**
     * To match PaymentMethodAbstract signature
     */
    protected function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }
}
