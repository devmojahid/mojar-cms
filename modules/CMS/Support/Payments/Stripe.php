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
use Stripe\Stripe as StripeMain;
use Stripe\Checkout\Session;
use Exception;

class Stripe extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $data = $this->getConfig();
            
            // Initialize Stripe with secret key
            StripeMain::setApiKey($data['secret_key']);
            
            \Log::info('Stripe Configuration', [
                'test_mode' => $data['is_test_mode'],
                'has_api_key' => !empty($data['secret_key'])
            ]);

            // Set fixed amount for testing like PayPal
            $amount = 100;

            $sessionParams = [
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => $params['currency'] ?? 'USD',
                        'unit_amount' => $amount * 100, // Convert to cents
                        'product_data' => [
                            'name' => $params['description'] ?? 'Order Payment',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $params['returnUrl'] ?? url('/payment/callback/stripe'),
                'cancel_url' => $params['cancelUrl'] ?? url('/payment/cancel/stripe'),
                'metadata' => [
                    'order_id' => $params['order_id'] ?? uniqid('order_'),
                ],
            ];

            \Log::info('Stripe Session Parameters', [
                'params' => array_merge(
                    $sessionParams,
                    ['api_key_length' => strlen($data['secret_key'])]
                )
            ]);

            try {
                $session = Session::create($sessionParams);
                
                \Log::info('Stripe Session Created', [
                    'session_id' => $session->id,
                    'url' => $session->url
                ]);

                if (empty($session->url)) {
                    throw new Exception('No checkout URL received from Stripe');
                }

                $this->setSuccessful(true);
                $this->setRedirect(true);
                $this->setRedirectURL($session->url);
                return $this;

            } catch (Exception $e) {
                \Log::error('Stripe Session Error', [
                    'error' => $e->getMessage(),
                    'class' => get_class($e)
                ]);
                throw $e;
            }

        } catch (Exception $e) {
            \Log::error('Stripe Payment Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'class' => get_class($e)
            ]);
            
            $this->addError($e->getMessage());
            $this->setSuccessful(false);
            throw $e;
        }
    }

    public function completed(array $params): PaymentMethodInterface
    {
        try {
            $data = $this->getConfig();
            StripeMain::setApiKey($data['secret_key']);

            $sessionId = $params['session_id'] ?? null;
            
            if (empty($sessionId)) {
                // If no session ID, check if we have an order ID
                $orderId = $params['order'] ?? null;
                if (!empty($orderId)) {
                    $this->setSuccessful(true);
                    return $this;
                }
                throw new Exception('No Stripe session ID provided');
            }

            try {
                $session = Session::retrieve($sessionId);
                
                \Log::info('Stripe Session Retrieved', [
                    'session_id' => $session->id,
                    'payment_status' => $session->payment_status
                ]);

                $this->setSuccessful($session->payment_status === 'paid');
                return $this;

            } catch (Exception $e) {
                \Log::error('Stripe Session Retrieval Error', [
                    'error' => $e->getMessage(),
                    'session_id' => $sessionId
                ]);
                throw $e;
            }

        } catch (Exception $e) {
            \Log::error('Stripe Completion Error', [
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

    private function getConfig(): array
    {
        $data = is_string($this->paymentMethod->data) 
            ? json_decode($this->paymentMethod->data, true) 
            : $this->paymentMethod->data;

        $isTestMode = ($data['mode'] ?? 'test') === 'test';
        
        if ($isTestMode) {
            $secretKey = $data['test_secret_key'] ?? '';
            $publishableKey = $data['test_publishable_key'] ?? '';
        } else {
            $secretKey = $data['live_secret_key'] ?? '';
            $publishableKey = $data['live_publishable_key'] ?? '';
        }

        if (empty($secretKey)) {
            throw new Exception('Stripe secret key not configured');
        }

        return [
            'secret_key' => $secretKey,
            'publishable_key' => $publishableKey,
            'is_test_mode' => $isTestMode
        ];
    }
}
