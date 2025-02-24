<?php

namespace Mojahid\EventManagement\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\EventManagement\Supports\BookingManager;
use Illuminate\Support\Facades\Log;

class BookingController extends FrontendController
{
    protected BookingManager $bookingManager;

    public function __construct(BookingManager $bookingManager)
    {
        $this->bookingManager = $bookingManager;
    }

    public function completed(Request $request): RedirectResponse
    {
        try {
            $booking = $this->bookingManager->find($request->get('booking'));
            
            if (!$booking) {
                throw new \Exception('Booking not found');
            }

            $completed = $booking->completed($request->all());

            if ($completed) {
                return redirect()
                    ->route('event.booking.success')
                    ->with('success', __('Payment completed successfully'));
            }

            return redirect()
                ->route('event.booking.failed')
                ->with('error', __('Payment failed. Please try again.'));

        } catch (\Exception $e) {
            Log::error('Booking payment completion error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->route('event.booking.failed')
                ->with('error', __('An error occurred during payment processing'));
        }
    }

    public function cancelled(Request $request): RedirectResponse
    {
        return redirect()
            ->route('event.booking.cancelled')
            ->with('warning', __('Payment was cancelled'));
    }
} 