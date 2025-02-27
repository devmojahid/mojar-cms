<?php

namespace Mojahid\EventManagement\Observers;

use Mojahid\Ecommerce\Models\Order;
use Mojahid\EventManagement\Models\EventBooking;

class OrderObserver
{
    public function updated(Order $order): void
    {
        if ($order->type !== 'events') {
            return;
        }

        if ($order->wasChanged('payment_status')) {
            // Update associated booking status
            EventBooking::where('order_id', $order->id)
                ->update(['payment_status' => $order->payment_status]);
        }
    }
}
