<?php

namespace Mojahid\EventManagement\Listeners;

use Mojahid\Ecommerce\Models\Order;
use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Models\EventTicket;
use Juzaweb\CMS\Models\User;

class OrderCreatedListener
{
    public static function handle(...$args): void
    {
        if (count($args) < 3) {
            return;
        }

        [$order, $items, $user] = $args;

        if (!$order instanceof Order) {
            return;
        }

        // Only process event ticket orders
        if ($order->type !== 'events') {
            return;
        }

        // Get the first order item since event bookings are single-ticket
        $orderItem = $order->orderItems->first();
        if (!$orderItem || !$orderItem->post_id) {
            return;
        }

        $ticket = EventTicket::findByEvent($orderItem->post_id);
        if (!$ticket) {
            return;
        }

        // Create booking record
        EventBooking::create([
            'event_id' => $orderItem->post_id,
            'ticket_id' => $ticket->id,
            'user_id' => $order->user_id,
            'name' => $order->name,
            'email' => $order->email,
            'phone' => $order->phone,
            'address' => $order->address,
            'city' => $order->city,
            'state' => $order->state,
            'zip' => $order->zip,
            'country' => $order->country,
            'status' => 'pending',
            'payment_method_id' => $order->payment_method_id,
            'payment_status' => $order->payment_status,
            'total' => $order->total,
            'quantity' => $orderItem->quantity,
            'code' => 'EVT-' . strtoupper(uniqid()),
            'order_id' => $order->id
        ]);
    }
}
