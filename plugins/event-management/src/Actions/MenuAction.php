<?php

namespace Mojahid\EventManagement\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Http\Resources\EventBookingCollection;

class MenuAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::BACKEND_INIT,
            [$this, 'addAdminMenus']
        );


        $this->addAction(
            Action::FRONTEND_INIT,
            [$this, 'addProfilePages']
        );
    }

    public function addAdminMenus(): void
    {
        HookAction::registerAdminPage(
            'event-management.event-bookings',
            [
                'title' => trans('evman::content.event_bookings'),
                'menu' => [

                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>',
                    'position' => 40,
                    'parent' => 'post-type.events'
                ]
            ]

        );

        HookAction::registerAdminPage(
            'event-management.settings',
            [
                'title' => trans('evman::content.setting'),
                'menu' => [

                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                    'position' => 50,
                    'parent' => 'post-type.events'
                ]
            ]
        );
    }

    public function addProfilePages(): void
    {
        HookAction::registerProfilePage(
            'event-booking',
            [
                'title' => trans('evman::content.booking'),
                'icon' => 'far fa-calendar-week',
                'position' => 10,
                'contents' => view()->exists('theme::profile.booking.index') ? 'theme::profile.booking.index' : 'evman::frontend.profile.booking.index',
                'key' => 'event-booking',
                'data' => [
                'bookings' => (new EventBookingCollection(
                        EventBooking::where('user_id', auth()?->user()?->id)
                            ->with(['event', 'ticket', 'paymentMethod'])
                            ->paginate(10)
                    ))->response()->getData(true),
                ]
            ]
        );
    }
}
