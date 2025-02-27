<?php

namespace Mojahid\EventManagement\Services;

use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Models\EventTicket;
use Juzaweb\CMS\Models\User;
use Mojahid\Ecommerce\Supports\Manager\OrderManager;
use Illuminate\Support\Facades\DB;

class BookingService
{
    protected OrderManager $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;
    }

    public function createBooking(array $data, EventTicket $ticket, ?User $user = null): EventBooking
    {
        try {
            DB::beginTransaction();

            // Create ecommerce order first
            $orderItems = [[
                'title' => $ticket->name,
                'type' => 'event_ticket',
                'thumbnail' => $ticket->event->thumbnail ?? null,
                'price' => $ticket->price,
                'quantity' => $data['quantity'] ?? 1,
                'post_id' => $ticket->event_id,
                'line_price' => $ticket->price * ($data['quantity'] ?? 1)
            ]];

            $order = $this->orderManager->createByItems(
                $data,
                $orderItems,
                $user ?? auth()->user()
            );

            // Create event booking record
            $booking = new EventBooking();
            $booking->fill($data);
            $booking->event_id = $ticket->event_id;
            $booking->ticket_id = $ticket->id;
            $booking->user_id = $user?->id;
            $booking->total = $ticket->price * ($data['quantity'] ?? 1);
            $booking->code = $booking->generateCode();
            $booking->payment_status = EventBooking::PAYMENT_STATUS_PENDING;
            $booking->payment_method_id = $data['payment_method_id'];
            $booking->order_id = $order->getOrder()->id; // Link to ecommerce order
            $booking->save();

            DB::commit();

            return $booking;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function validateTicketAvailability(EventTicket $ticket, int $quantity = 1): bool
    {
        if ($ticket->capacity && $ticket->getBookedCount() + $quantity > $ticket->capacity) {
            return false;
        }

        if ($ticket->max_ticket_number && $quantity > $ticket->max_ticket_number) {
            return false;
        }

        return true;
    }
}
