<?php

namespace Mojahid\Ecommerce\Supports\Payments;

use Mojahid\Ecommerce\Abstracts\PaymentMethodAbstract;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;
use Omnipay\Omnipay;
use Omnipay\Common\GatewayInterface;
use Mojahid\Ecommerce\Models\Order;

class Mollie extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            // Set fixed amount for testing like PayPal and Stripe
            $amount = 100;
            if (empty($amount) || (float)$amount <= 0) {
                \Log::error('Mollie Payment Error: Invalid amount', ['amount' => $amount]);
                throw new \Exception('Invalid amount. Amount must be greater than zero.');
            }
            
            $gateway = $this->getGateway();
            
            \Log::info('Mollie Gateway Configuration', [
                'test_mode' => $gateway->getTestMode(),
                'has_api_key' => !empty($gateway->getApiKey())
            ]);
           
            $purchaseParams = [
                'amount' => $amount,
                'currency' => $params['currency'] ?? 'USD',
                'description' => $params['description'] ?? 'Order Payment',
                'returnUrl' => $params['returnUrl'] ?? url('/payment/callback/mollie'),
                'metadata' => [
                    'order_id' => $params['order_id'] ?? uniqid('order_'),
                ],
            ];

             // Only add webhook URL if not in local environment
            if (!app()->environment('local')) {
                $purchaseParams['notifyUrl'] = $params['notifyUrl'] ?? url('/payment/webhook/mollie');
            }
            
            \Log::info('Mollie Purchase Request', [
                'params' => array_merge(
                    $purchaseParams,
                    ['api_key_length' => strlen($gateway->getApiKey())]
                )
            ]);
            
            $response = $gateway->purchase($purchaseParams)->send();

            \Log::info('Mollie Purchase Response', [
                'is_successful' => $response->isSuccessful(),
                'is_redirect' => $response->isRedirect(),
                'redirect_url' => $response->isRedirect() ? $response->getRedirectUrl() : null,
                'transaction_reference' => $response->getTransactionReference()
            ]);
            
            if ($response->isSuccessful()) {
                $this->setSuccessful(true);
                $this->setRedirect(false);
                return $this;
            } 
            
            if ($response->isRedirect()) {
                $redirectUrl = $response->getRedirectUrl();
                
                if (empty($redirectUrl)) {
                    throw new \Exception('No redirect URL received from Mollie');
                }
                
                $this->setSuccessful(true);
                $this->setRedirect(true);
                $this->setRedirectURL($redirectUrl);
                return $this;
            }

            throw new \Exception($response->getMessage() ?? 'Payment initialization failed');
        } catch (\Exception $e) {    
            \Log::error('Mollie Payment Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->addError($e->getMessage());
            $this->setSuccessful(false);
            throw $e;
        }
    }

    public function completed(array $params): PaymentMethodInterface
    {   
        try {
            $gateway = $this->getGateway();
            
            // Get payment ID from return parameters
            $paymentId = $params['id'] ?? null;
            
            if (empty($paymentId)) {
                // If no payment ID, check if we have an order ID
                $orderId = $params['order'] ?? null;
                if (!empty($orderId)) {
                    // Update order status directly
                    $order = Order::whereCode($orderId)->first();
                    if ($order) {
                        $order->payment_status = 'paid';
                        $order->save();
                        $this->setSuccessful(true);
                        return $this;
                    }
                }
                throw new \Exception('No payment ID provided');
            }

            // Fetch transaction status from Mollie
            $response = $gateway->fetchTransaction([
                'transactionReference' => $paymentId
            ])->send();
            
            \Log::info('Mollie Completion Response', [
                'payment_id' => $paymentId,
                'is_paid' => $response->isPaid(),
                'status' => $response->getData()['status'] ?? null
            ]);

            if ($response->isPaid()) {
                $this->setSuccessful(true);
                
                // Update order if exists
                if (!empty($params['order'])) {
                    $order = Order::whereCode($params['order'])->first();
                    if ($order) {
                        $order->payment_status = 'paid';
                        $order->save();
                    }
                }
            } else {
                $this->setSuccessful(false);
                $this->addError('Payment not completed');
            }

            return $this;
        } catch (\Exception $e) {
            \Log::error('Mollie Completion Error', [
                'message' => $e->getMessage(),
                'params' => $params
            ]);
            
            $this->addError($e->getMessage());
            $this->setSuccessful(false);
            throw $e;
        }
    }
    
    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    private function getGateway(): GatewayInterface 
    {
        $gateway = Omnipay::create('Mollie');
        
        $apiKeyData = $this->getApiKey();
        $gateway->setApiKey('test_uMfQEwF3sk43WFkHhFvRFJbGevSGgt');
        // $gateway->setApiKey($apiKeyData['apiKey']);
        $gateway->setTestMode($apiKeyData['testMode']);
        
        return $gateway;
    }

    private function getApiKey(): array
    {
        $data = is_string($this->paymentMethod->data) 
            ? json_decode($this->paymentMethod->data, true) 
            : $this->paymentMethod->data;
        
        $testMode = ($data['mode'] ?? 'sandbox') === 'sandbox';
        
        $apiKey = $testMode ? ($data['sandbox_api_key'] ?? '') : ($data['live_api_key'] ?? '');
        
        if (empty($apiKey)) {
            $errorMsg = 'Mollie API key not configured for ' . ($testMode ? 'sandbox' : 'live') . ' mode';
            \Log::error('Mollie API Key Error', ['error' => $errorMsg]);
            throw new \Exception($errorMsg);
        }
        
        \Log::info('Using Mollie API Key', [
            'mode' => $testMode ? 'test' : 'live',
            'key_prefix' => substr($apiKey, 0, 5),
            'key_length' => strlen($apiKey)
        ]);
        
        return [
            'apiKey' => $apiKey,
            'testMode' => $testMode
        ];
    }
}