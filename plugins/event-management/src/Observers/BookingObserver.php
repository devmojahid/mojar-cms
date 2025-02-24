<?php

namespace Mojahid\EventManagement\Observers;

use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Notifications\BookingNotification;

class BookingObserver
{
    public function created(EventBooking $booking): void
    {
        if ($booking->email) {
            $booking->notify(new BookingNotification($booking));
        }
    }

    public function updated(EventBooking $booking): void
    {
        if ($booking->wasChanged('payment_status') && 
            $booking->payment_status === EventBooking::PAYMENT_STATUS_COMPLETED
        ) {
            // Send payment confirmation
            $booking->notify(new BookingNotification($booking));
            
            // Trigger booking completed event
            event(new BookingCompleted($booking));
        }
    }
} 