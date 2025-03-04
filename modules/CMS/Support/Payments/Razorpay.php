<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Razorpay\Api\Api;

class Razorpay extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $api = $this->getApiClient();
            
            $order = $api->order->create([
                'amount' => $this->formatAmount($params['amount']),
                'currency' => $params['currency'] ?? 'INR',
                'receipt' => $params['order_id'] ?? uniqid(),
                'payment_capture' => 1
            ]);

            $this->setRedirect(true);
            $this->setRedirectURL($this->getCheckoutUrl($order->id, $params));
            $this->status = PaymentStatus::PENDING;

        } catch (\Exception $e) {
            $this->handleError($e);
        }

        return $this;
    }

    public function completed(array $params): PaymentMethodInterface
    {
        try {
            $api = $this->getApiClient();
            $payment = $api->payment->fetch($params['razorpay_payment_id']);

            $this->successful = $payment->status === 'captured';
            $this->status = $this->successful ? PaymentStatus::COMPLETED : PaymentStatus::FAILED;

        } catch (\Exception $e) {
            $this->handleError($e);
        }

        return $this;
    }

    private function getApiClient(): Api
    {
        $data = $this->paymentMethod->data;
        $keyId = ($data['mode'] === 'live') ? $data['live_key_id'] : $data['test_key_id'];
        $keySecret = ($data['mode'] === 'live') ? $data['live_key_secret'] : $data['test_key_secret'];

        return new Api($keyId, $keySecret);
    }

    private function getCheckoutUrl(string $orderId, array $params): string
    {
        return route('payment.razorpay.checkout', [
            'order_id' => $orderId,
            'amount' => $this->formatAmount($params['amount']),
            'currency' => $params['currency'] ?? 'INR',
            'callback_url' => $params['returnUrl']
        ]);
    }

    private function formatAmount(float $amount): int
    {
        return (int) ($amount * 100);
    }

    private function handleError(\Exception $e): void
    {
        $this->setSuccessful(false);
        $this->status = PaymentStatus::FAILED;
        $this->setMessage($e->getMessage());
        $this->logError($e);
    }
}