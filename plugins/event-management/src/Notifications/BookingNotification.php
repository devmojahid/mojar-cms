<?php

namespace Mojahid\EventManagement\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Mojahid\EventManagement\Models\EventBooking;

class BookingNotification extends Notification
{
    protected EventBooking $booking;

    public function __construct(EventBooking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Event Booking Confirmation - :code', ['code' => $this->booking->code]))
            ->line(__('Thank you for your booking.'))
            ->line(__('Booking Details:'))
            ->line(__('Event: :event', ['event' => $this->booking->event->title]))
            ->line(__('Ticket: :ticket', ['ticket' => $this->booking->ticket->name]))
            ->line(__('Quantity: :qty', ['qty' => $this->booking->quantity]))
            ->line(__('Total: :total', ['total' => $this->booking->total]))
            ->line(__('Status: :status', ['status' => $this->booking->payment_status]));
    }
} 