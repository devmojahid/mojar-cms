<?php

namespace Mojahid\Ecommerce\Supports\Payments;

use Mojahid\Ecommerce\Abstracts\PaymentMethodAbstract;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;
use Mojahid\Ecommerce\Models\Order;

class Cod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            \Log::info('COD Purchase Request', [
                'params' => array_merge(
                    $params,
                    ['order_id' => $params['order_id'] ?? uniqid('order_')]
                )
            ]);

            // For COD, we'll set successful but pending payment
            $this->setSuccessful(true);
            
            // Set redirect to success page directly
            $this->setRedirect(true);
            $this->setRedirectURL($params['returnUrl'] ?? url('/payment/callback/cod'));

            return $this;
        } catch (\Exception $e) {    
            \Log::error('COD Payment Error', [
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
            // Get order ID from parameters
            $orderId = $params['order'] ?? null;
            
            if (empty($orderId)) {
                throw new \Exception('No order ID provided');
            }

            // Update order status to pending (since it's COD)
            $order = Order::whereCode($orderId)->first();
            if ($order) {
                $order->payment_status = 'pending';
                $order->save();
                
                \Log::info('COD Order Status Updated', [
                    'order_id' => $orderId,
                    'status' => 'pending'
                ]);
            }

            $this->setSuccessful(true);
            $this->setMessage('Your order has been placed successfully. Please pay on delivery.');
            
            return $this;
        } catch (\Exception $e) {
            \Log::error('COD Completion Error', [
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
}