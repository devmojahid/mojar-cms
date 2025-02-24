<?php

namespace Mojahid\EventManagement\Supports;

use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Support\Payment;
use Mojahid\EventManagement\Models\EventBooking;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class EventBookingOrder implements \Mojahid\Ecommerce\Supports\OrderInterface
{
    protected EventBooking $booking;
    protected Payment $payment;
    protected BookingManager $bookingManager;

    public function __construct(EventBooking $booking, Payment $payment) 
    {
        $this->booking = $booking;
        $this->payment = $payment;
    }

    public function purchase(): PaymentMethodInterface
    {
        return $this->payment->purchase(
            $this->booking->paymentMethod,
            $this->getPurchaseParams()
        );
    }

    public function completed(?array $input): bool
    {
        try {
            $params = array_merge($this->getPurchaseParams(), $input ?? []);
            
            $completed = $this->payment->completed(
                $this->booking->paymentMethod,
                $params
            );

            if ($completed->isSuccessful()) {
                $this->booking->update([
                    'payment_status' => EventBooking::PAYMENT_STATUS_COMPLETED,
                    'status' => 'completed'
                ]);

                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Event booking payment error', [
                'booking_id' => $this->booking->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function getPaymentRedirectURL(): string
    {
        $response = $this->purchase();
        return $response->getRedirectURL() ?? $this->getReturnURL();
    }

    public function getOrder(): EventBooking
    {
        return $this->booking;
    }

    public function getItems(): Collection
    {
        return collect([$this->booking]);
    }

    protected function getPurchaseParams(): array
    {
        return [
            'amount' => $this->booking->total,
            'currency' => get_config('event_currency', 'USD'),
            'cancelUrl' => $this->getCancelURL(),
            'returnUrl' => $this->getReturnURL(),
            'orderId' => $this->booking->id
        ];
    }

    protected function getReturnURL(): string
    {
        return route('event.booking.completed', [
            'booking' => $this->booking->id,
            'method' => $this->booking->payment_method_id
        ]);
    }

    protected function getCancelURL(): string
    {
        return route('event.booking.cancelled', [
            'booking' => $this->booking->id,
            'method' => $this->booking->payment_method_id
        ]);
    }

    public function processPayment(EventBooking $booking)
    {
    $bookingOrder = $this->bookingManager->processPayment($booking);
    
    try {
        $purchase = $bookingOrder->purchase();
        
        if ($purchase->isRedirect()) {
            return redirect()->to($purchase->getRedirectURL());
        }
        
        // Handle direct payment response
        if ($purchase->isSuccessful()) {
            $booking->update([
                'payment_status' => EventBooking::PAYMENT_STATUS_COMPLETED
            ]);
            
            return redirect()->route('event.booking.success');
        }
        
        return redirect()->route('event.booking.failed');
        
    } catch (\Exception $e) {
        Log::error('Payment processing error', [
            'booking_id' => $booking->id,
            'error' => $e->getMessage()
        ]);
        
            return redirect()->back()->with('error', 'Payment processing failed');
        }
    }
} 