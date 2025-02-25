<?php

namespace Juzaweb\CMS\Support\Payments;

use Juzaweb\CMS\Abstracts\PaymentMethodAbstract;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Omnipay\Omnipay;
use Omnipay\Common\Exception\InvalidRequestException;
use Exception;

class Stripe extends PaymentMethodAbstract implements PaymentMethodInterface
{
    /**
     * Perform the "purchase" step for Stripe PaymentIntents.
     *
     * @param  array  $params  [amount, currency, token/paymentMethod, returnUrl, etc.]
     * @return PaymentMethodInterface
     */
    public function purchase(array $params): PaymentMethodInterface
    {
        // 1) Build the Omnipay gateway for PaymentIntents
        //    (Ensure you have "omnipay/stripe" installed and "use Omnipay\Omnipay;")
        $gateway = Omnipay::create('Stripe_PaymentIntents');

        // 2) Pull your secret key from $this->paymentMethod->data
        //    (The "data" field is JSON. E.g. {"sandbox_secret": "..."} or "live_secret")
        $stripeData = json_decode($this->paymentMethod->data, true) ?: [];
        
        // If you store separate keys for sandbox vs. production, pick the right one:
        // Adjust as needed based on your config
        $secretKey = $stripeData['sandbox_secret'] ?? $stripeData['live_secret'] ?? null;
        if (empty($secretKey)) {
            // Fallback error
            $this->setSuccessful(false);
            $this->setMessage('Stripe secret key missing in PaymentMethod data.');
            $this->status = PaymentStatus::FAILED;
            return $this;
        }

        // Assign the secret key
        $gateway->setApiKey($secretKey);

        /**
         * 3) Prepare the purchase() request:
         *
         * Stripe PaymentIntents supports two ways to pass card data:
         *  - 'paymentMethod' => 'pm_xxxx' (preferred) for Payment Intents
         *  - 'token' => 'tok_xxxx' for older style
         *
         * If your front-end or Stripe.js returns “pm_card_visa”, 
         * use `'paymentMethod' => 'pm_card_visa'`.
         *
         * If you are still using "tok_xxxx", 
         * set `'token' => 'tok_xxxx'` instead.
         */
        $requestData = [
            'amount'      => $params['amount'] ?? 0,
            'currency'    => $params['currency'] ?? 'USD',
            'description' => $params['description'] ?? 'Order Payment',
            // If you have `paymentMethod` from your front-end:
            'paymentMethod' => $params['paymentMethod'] ?? null,
            // Alternatively if you have a Stripe token "tok_xxxx"
            'token'         => $params['token'] ?? null,

            // If you want auto-confirmation:
            'confirm'    => true,

            // If confirm=true, you MUST pass returnUrl for 3D-Secure
            'returnUrl'  => $params['returnUrl'] ?? '',
        ];

        try {
            // 4) Send purchase request to Stripe via Omnipay
            $response = $gateway->purchase($requestData)->send();

            // 5) Check response for success or redirect
            if ($response->isSuccessful()) {
                // Payment fully completed immediately (no 3D-Secure needed).
                $this->setRedirect(false);
                $this->setSuccessful(true);
                $this->status = PaymentStatus::COMPLETED;
            } elseif ($response->isRedirect()) {
                // Payment needs 3D-Secure or bank redirect:
                $this->setRedirect(true);
                $this->setRedirectURL($response->getRedirectUrl());
                $this->setSuccessful(false);
                $this->status = PaymentStatus::PENDING;
            } else {
                // Payment failed or was invalid
                $this->setRedirect(false);
                $this->setSuccessful(false);
                $this->status = PaymentStatus::FAILED;
                $this->setMessage($response->getMessage());
            }
        } catch (InvalidRequestException $e) {
            // Example: "The source parameter is required" or "No such token: pm_card_visa"
            $this->setSuccessful(false);
            $this->setMessage($e->getMessage());
            $this->status = PaymentStatus::FAILED;
        } catch (Exception $e) {
            // Catch any other errors
            $this->setSuccessful(false);
            $this->setMessage($e->getMessage());
            $this->status = PaymentStatus::FAILED;
        }

        return $this;
    }

    /**
     * After the user returns from Stripe or if "confirm" is needed again,
     * we call "completed" to finalize the PaymentIntent.
     *
     * @param  array  $params  Usually includes payment_intent or such
     * @return PaymentMethodInterface
     */
    public function completed(array $params): PaymentMethodInterface
    {
        // Only relevant if 3D-Secure or "returnUrl" callback flow was triggered
        $stripeData = json_decode($this->paymentMethod->data, true) ?: [];
        $secretKey = $stripeData['sandbox_secret'] ?? $stripeData['live_secret'] ?? null;

        $gateway = Omnipay::create('Stripe_PaymentIntents');
        $gateway->setApiKey($secretKey);

        // If user returns with: 
        //   GET /payment/completed?order=12345&method=1&payment_intent=pi_123&payment_intent_client_secret=...
        // Then we can "confirm" again to finalize:

        $paymentIntentId = $params['payment_intent'] ?? null;
        if (empty($paymentIntentId)) {
            // Possibly no ID => Payment fails
            $this->setSuccessful(false);
            $this->status = PaymentStatus::FAILED;
            $this->setMessage('No payment_intent provided.');
            return $this;
        }

        try {
            // Confirm the PaymentIntent
            $response = $gateway->confirm([
                'paymentIntentReference' => $paymentIntentId,
                'returnUrl' => $params['returnUrl'] ?? '',
            ])->send();

            if ($response->isSuccessful()) {
                // The user has authenticated and final payment is done
                $this->setSuccessful(true);
                $this->status = PaymentStatus::COMPLETED;
            } elseif ($response->isRedirect()) {
                // Rarely, it might redirect again
                $this->setRedirect(true);
                $this->setRedirectURL($response->getRedirectUrl());
                $this->setSuccessful(false);
                $this->status = PaymentStatus::PENDING;
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

    /**
     * Must define to avoid "must be compatible with PaymentMethodAbstract".
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




// Final Checkout Flow Example

// Checkout:
// public function checkout(Request $request)
// {
    // 1) Create your $order via $this->orderManager->createByCart(...)
    // 2) $paymentMethodModel = PaymentMethod::find($request->input('payment_method_id'));
    // 3) $purchase = $orderWrapper->purchase(); // calls the method e.g. RazorpayPaymentMethod->purchase()
    
//     if ($purchase->isRedirect()) {
//         return redirect()->away($purchase->getRedirectURL());
//     }

//     if ($purchase->isSuccessful()) {
//         return redirect()->to($this->getThanksPageURL($orderWrapper->getOrder()));
//     }

//     return back()->with('error', $purchase->getMessage());
// }


// Complete

// public function completed(Request $request)
// {
//     $orderCode = $request->input('order');
//     $helper = $this->orderManager->find($orderCode);

//     $payment = $helper->completed($request->all()); 
    
//     if ($payment->isSuccessful()) {
//         // Payment done
//         return redirect()->to($this->getThanksPageURL($helper->getOrder()));
//     } elseif ($payment->isRedirect()) {
//         return redirect()->away($payment->getRedirectURL());
//     } else {
//         return redirect()->route('checkout')->with('error', $payment->getMessage());
//     }
// }
