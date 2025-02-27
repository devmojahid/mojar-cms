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
        if ($booking->wasChanged('payment_status')) {
            // Update associated order status
            if ($booking->order) {
                $booking->order->update([
                    'payment_status' => $booking->payment_status
                ]);
            }

            if ($booking->payment_status === EventBooking::PAYMENT_STATUS_COMPLETED) {
                // Send notifications etc
                $booking->notify(new BookingNotification($booking));
                event(new BookingCompleted($booking));
            }
        }
    }
}
