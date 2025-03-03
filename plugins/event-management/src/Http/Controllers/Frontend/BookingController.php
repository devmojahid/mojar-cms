<?php

namespace Mojahid\EventManagement\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\EventManagement\Supports\BookingManager;
use Illuminate\Support\Facades\Log;
use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Http\Resources\EventBookingResource;
use Juzaweb\Payment\Models\PaymentMethod;
use Juzaweb\CMS\Facades\HookAction;

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

    public function details(Request $request, string $code)
    {
        $booking = EventBooking::where('code', $code)
            ->where('user_id', auth()->id())
            ->with(['event', 'ticket', 'paymentMethod'])
            ->firstOrFail();

        $title = trans('evman::content.booking_details');

        $booking = (new EventBookingResource($booking))->resolve();
        $pages = collect(HookAction::getProfilePages());
        $user = auth()->user();

        $page = [
            'title' => $title,
            'key' => 'event-booking-detail',
            'contents' => view()->exists('theme::profile.booking.detail') ? 
                          'theme::profile.booking.detail' : 
                          'evman::frontend.profile.booking.detail',
            'data' => [
                'booking' => $booking
            ]
        ];

        return $this->view('theme::profile.index', compact(
            'title',
            'pages',
            'page',
            'user'
        ));
    }
    
    public function payment(Request $request, string $code)
    {
        $booking = EventBooking::where('code', $code)
            ->where('user_id', auth()->id())
            ->with(['event', 'ticket', 'paymentMethod'])
            ->firstOrFail();
            
        if ($booking->payment_status === EventBooking::PAYMENT_STATUS_COMPLETED) {
            return redirect()->route('event.booking.details', ['code' => $booking->code])
                ->with('success', trans('evman::content.payment_already_completed'));
        }
        
        // Get all profile pages for sidebar menu
        $pages = collect(HookAction::getProfilePages());
        
        // Current user
        $user = auth()->user();
        
        // Get available payment methods
        $payment_methods = [];
        
        $title = trans('evman::content.complete_payment');
        $booking = (new EventBookingResource($booking))->resolve();
        
        // Create a page array compatible with the profile layout
        $page = [
            'title' => $title,
            'key' => 'event-booking-payment',
            'contents' => view()->exists('theme::profile.booking.payment') ? 
                          'theme::profile.booking.payment' : 
                          'evman::frontend.booking.payment',
            'data' => [
                'booking' => $booking,
                'payment_methods' => $payment_methods
            ]
        ];
        
        // Render using the profile index template to maintain layout consistency
        return $this->view(
            'theme::profile.index',
            compact(
                'title',
                'pages',
                'page',
                'user'
            )
        );
    }
} 