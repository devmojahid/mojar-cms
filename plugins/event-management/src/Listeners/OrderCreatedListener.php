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

        // Loop through items to find event tickets
        foreach ($items as $item) {
            if (!isset($item['type']) || $item['type'] !== 'events') {
                continue;
            }

            if (empty($item['post_id'])) {
                continue;
            }

            // dd("Order",$order, "Items",$items, "user",$user, "args",$args);
            // $ticket = EventTicket::findByEvent($item['post_id']);
            // if (!$ticket) {
            //     continue;
            // }

            // Create booking record for each event ticket

            EventBooking::create([
                'event_id' => $item['post_id'],
                // 'ticket_id' => $ticket->id,
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
                'total' => $item['line_price'] ?? $item['price'] * $item['quantity'],
                'quantity' => $item['quantity'],
                'code' => 'EVT-' . strtoupper(uniqid()),
                'order_id' => $order->id,
                'booking_date' => now(),
                'notes' => $order->notes,
            ]);
        }
    }
}
