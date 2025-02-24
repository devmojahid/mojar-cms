<?php

namespace Mojahid\EventManagement\Services;

use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Models\EventTicket;
use Juzaweb\CMS\Models\User;

class BookingService
{
    public function createBooking(array $data, EventTicket $ticket, ?User $user = null): EventBooking
    {
        $booking = new EventBooking();
        $booking->fill($data);
        $booking->event_id = $ticket->event_id;
        $booking->ticket_id = $ticket->id;
        $booking->user_id = $user?->id;
        $booking->total = $ticket->price * ($data['quantity'] ?? 1);
        $booking->code = $booking->generateCode();
        $booking->save();
        
        return $booking;
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