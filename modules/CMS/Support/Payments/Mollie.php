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
use Omnipay\Omnipay;
use Omnipay\Common\GatewayInterface;
use Mojahid\Ecommerce\Models\Order;

class Mollie extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $amount = 100;
            if (empty($amount) || (float)$amount <= 0) {
                \Log::error('Mollie Payment Error: Invalid amount', ['amount' => $amount]);
                throw new \Exception('Invalid amount. Amount must be greater than zero.');
            }
            
            // Get API key
            $apiKeyData = $this->getApiKey();
            $apiKey = $apiKeyData['apiKey'];
            
            
            $gateway = $this->getGateway();
           
            $purchaseParams = [
                'amount' => $amount,
                'currency' => $params['currency'] ?? 'USD',
                'description' => $params['description'] ?? 'Order Payment',
                'returnUrl' => $params['returnUrl'] ?? url('/payment/callback/mollie'),
                'metadata' => [
                    'order_id' => $params['order_id'] ?? uniqid('order_'),
                ],
            ];

            if (!app()->environment('local')) {
                $purchaseParams['notifyUrl'] = $params['notifyUrl'] ?? url('/payment/webhook/mollie');
            }
            
            \Log::info('Mollie Purchase Request', [
                'params' => $purchaseParams,
            ]);
            
            $response = $gateway->purchase($purchaseParams)->send();
            if ($response->isSuccessful()) {
                $this->setSuccessful(true);
                $this->setRedirect(false);
                return $this;
            } elseif ($response->isRedirect()) {
                $redirectUrl = $response->getRedirectUrl();
                
                if (empty($redirectUrl)) {
                    throw new \Exception('No redirect URL received from Mollie');
                }
                
                $this->setSuccessful(true);
                $this->setRedirect(true);
                $this->setRedirectURL($redirectUrl);
                return $this;
            } else {
                $error = $response->getMessage() ?? 'Payment initialization failed';
                throw new \Exception($error);
            }
        } catch (\Exception $e) {    
            $this->addError($e->getMessage());
            $this->setSuccessful(false);
            throw $e;
        }
    }

    public function completed(array $params): PaymentMethodInterface
    {   
       
        $order = Order::whereCode($params['order'])->first();
        $order->payment_status = 'paid';
        $order->save();
        return $this;
    }
    
    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    public function getGateway() 
    {
        $gateway = Omnipay::create('Mollie');
        // $gateway->setApiKey($this->getApiKey()['apiKey']);
        $gateway->setApiKey('test_uMfQEwF3sk43WFkHhFvRFJbGevSGgt');
        return $gateway;
    }

    /**
     * Get API key and test mode status
     * 
     * @return array
     * @throws \Exception
     */
    private function getApiKey(): array
    {
        // Get payment method data
        $data = is_string($this->paymentMethod->data) 
            ? json_decode($this->paymentMethod->data, true) 
            : $this->paymentMethod->data;
        
        // Determine test/sandbox mode
        $testMode = ($data['mode'] ?? 'sandbox') === 'sandbox';
        
        // Get the appropriate API key based on mode
        $apiKey = $testMode ? ($data['sandbox_api_key'] ?? '') : ($data['live_api_key'] ?? '');
        
        // Validate API key
        if (empty($apiKey)) {
            $errorMsg = 'Mollie API key is not configured for ' . ($testMode ? 'sandbox' : 'live') . ' mode';
            \Log::error('Mollie API Key Error', ['error' => $errorMsg]);
            throw new \Exception($errorMsg);
        }
        
        // Log API key info without revealing full key
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