<?php

namespace Mojahid\EventManagement\Supports;

use Mojahid\Ecommerce\Supports\Payment;
use Mojahid\EventManagement\Models\EventBooking;

class BookingManager
{
    protected Payment $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function find($bookingId): ?EventBookingOrder
    {
        $booking = EventBooking::find($bookingId);
        
        if (!$booking) {
            return null;
        }

        return new EventBookingOrder($booking, $this->payment);
    }

    public function processPayment(EventBooking $booking): EventBookingOrder
    {
        return new EventBookingOrder($booking, $this->payment);
    }
} 