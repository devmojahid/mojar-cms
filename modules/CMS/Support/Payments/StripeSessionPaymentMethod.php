<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Exception;

class StripeSessionPaymentMethod extends PaymentMethodAbstract implements PaymentMethodInterface
{
    /**
     * 1) Create a Stripe Checkout Session
     *    Then redirect user to Stripe’s hosted page
     */
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            // 1) Load Stripe credentials from DB
            $stripeData  = json_decode($this->paymentMethod->data, true) ?: [];
            $secretKey   = $stripeData['secret_key'] ?? null;
            if (!$secretKey) {
                $this->setSuccessful(false);
                $this->setMessage('Stripe secret_key missing in payment method data.');
                $this->status = PaymentStatus::FAILED;
                return $this;
            }

            // 2) Initialize Stripe
            Stripe::setApiKey($secretKey);

            // 3) Convert amount to cents if needed
            //    For example, if your $params['amount'] is "10.00" and currency is USD
            //    Stripe expects an integer amount in cents => 1000
            $amount = (float) ($params['amount'] ?? 0);
            $amountInCents = (int) round($amount * 100);

            // 4) Build line items (simple example: one line item)
            //    For multiple items, build an array of line_items
            $lineItems = [
                [
                    'price_data' => [
                        'currency'     => $params['currency'] ?? 'USD',
                        'product_data' => [
                            'name' => $params['description'] ?? 'Payment',
                        ],
                        'unit_amount'  => $amountInCents,
                    ],
                    'quantity' => 1,
                ],
            ];

            // 5) Create Checkout Session
            //    `mode` => 'payment' for one-time
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items'           => $lineItems,
                'mode'                 => 'payment',
                'success_url'          => ($params['returnUrl'] ?? '') . '?stripe_session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'           => $params['cancelUrl'] ?? ($params['returnUrl'] ?? ''),
            ]);

            // 6) If the session is created, we must redirect user to $session->url
            if (!empty($session->url)) {
                $this->setRedirect(true);
                $this->setRedirectURL($session->url);
                $this->setSuccessful(false);
                $this->status = PaymentStatus::PENDING;
            } else {
                // No URL => something failed
                $this->setRedirect(false);
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $this->setMessage('Could not create Stripe Checkout Session URL.');
            }
        } catch (Exception $e) {
            // On error, set payment as failed
            $this->setRedirect(false);
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    /**
     * 2) Called once user returns from Stripe or in your "completed" route
     *    to confirm the payment was successful
     */
    public function completed(array $params): PaymentMethodInterface
    {
        try {
            // 1) Retrieve session ID from query or request
            //    e.g. ?stripe_session_id=cs_test_abc123
            $stripeData   = json_decode($this->paymentMethod->data, true) ?: [];
            $secretKey    = $stripeData['secret_key'] ?? null;
            $sessionId    = $params['stripe_session_id'] ?? null;

            if (!$secretKey) {
                $this->setSuccessful(false);
                $this->setMessage('Stripe secret key missing in data.');
                $this->status = PaymentStatus::FAILED;
                return $this;
            }

            if (!$sessionId) {
                // If we have no session ID, can't verify
                $this->setSuccessful(false);
                $this->setMessage('No stripe_session_id returned from Stripe.');
                $this->status = PaymentStatus::FAILED;
                return $this;
            }

            // 2) Re-init Stripe
            Stripe::setApiKey($secretKey);

            // 3) Retrieve the session from Stripe
            $session = StripeSession::retrieve($sessionId);

            // 4) Check if payment_status = 'paid'
            //    or 'unpaid', 'no_payment_required'
            if ($session->payment_status === 'paid') {
                $this->setSuccessful(true);
                $this->status = PaymentStatus::COMPLETED;
            } else {
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $this->setMessage("Stripe session payment_status: {$session->payment_status}");
            }
        } catch (Exception $e) {
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage($e->getMessage());
        }

        return $this;
    }

    /**
     * Must implement to match PaymentMethodAbstract
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
