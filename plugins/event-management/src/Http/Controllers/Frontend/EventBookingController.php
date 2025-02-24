<?php

namespace Mojahid\EventManagement\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\EventManagement\Services\BookingService;
use Mojahid\EventManagement\Http\Requests\BookingRequest;
use Mojahid\EventManagement\Models\EventTicket;
use Mojahid\EventManagement\Services\BookingManager;

class EventBookingController extends FrontendController
{
    protected BookingService $bookingService;
    protected BookingManager $bookingManager;

    public function __construct(
        BookingService $bookingService,
        BookingManager $bookingManager
    ) {
        $this->bookingService = $bookingService;
        $this->bookingManager = $bookingManager;
    }

    public function book(BookingRequest $request): JsonResponse
    {
        $ticket = EventTicket::findOrFail($request->input('ticket_id'));
        
        if (!$this->bookingService->validateTicketAvailability($ticket, $request->input('quantity', 1))) {
            return $this->error([
                'message' => __('Ticket not available for selected quantity')
            ]);
        }

        $booking = $this->bookingService->createBooking(
            $request->validated(),
            $ticket,
            auth()->user()
        );

        try {
            $bookingOrder = $this->bookingManager->processPayment($booking);
            $purchase = $bookingOrder->purchase();

            return $this->success([
                'redirect' => $purchase->isRedirect() ? 
                    $purchase->getRedirectURL() : 
                    route('event.booking.success', ['booking' => $booking->code])
            ]);

        } catch (\Exception $e) {
            report($e);
            return $this->error(['message' => $e->getMessage()]);
        }
    }
} 