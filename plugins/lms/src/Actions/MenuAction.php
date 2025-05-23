<?php

namespace Mojahid\Lms\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Mojahid\Lms\Models\Course;
use Mojahid\Lms\Http\Resources\CourseCollection;

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
            'lms.settings',
            [
                'title' => trans('lms::content.settings'),
                'menu' => [


                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                    'position' => 50,
                    'parent' => 'post-type.courses'
                ]
            ]
        );
    }

    public function addProfilePages(): void
    {
        HookAction::registerProfilePage(
            'enrolled-courses',
            [
                'title' => trans('lms::content.enrolled_courses'),
                'key' => 'enrolled-courses',
                'contents' => view()->exists('theme::profile.enrolled-courses.index') ? 'theme::profile.enrolled-courses.index' : 'lms::frontend.profile.enrolled-courses.index',
                'icon' => 'far fa-graduation-cap',
                'position' => 10,
                'data' => [
                    'courses' => (new CourseCollection(
                        Course::where('type', 'courses')
                        ->whereHas('orderItems', function ($query) {
                            $query->where('type', 'courses')
                                ->whereHas('order', function($subQuery) {
                                    $subQuery->where('user_id', auth()?->user()?->id)
                                        ->where('payment_status', 'completed');
                                });
                        })
                        ->with([
                            'topics.lessons', 
                            'orders' => function($query) {
                                $query->where('user_id', auth()?->user()?->id)
                                    ->where('payment_status', 'completed');
                            }, 
                            'orders.paymentMethod'
                        ])
                        ->paginate(10)
                    ))->response()->getData(true),
                ]
            ]
        );
    }
}
