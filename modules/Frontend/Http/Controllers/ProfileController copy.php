<?php

namespace Juzaweb\Frontend\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Juzaweb\Backend\Http\Resources\UserResource;
use Juzaweb\Backend\Repositories\UserRepository;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Juzaweb\Frontend\Http\Requests\ChangePasswordRequest;
use Juzaweb\Frontend\Http\Requests\UpdateProfileRequest;

class ProfileController extends FrontendController
{
    public function __construct(protected UserRepository $userRepository) {}

    public function index($slug = null)
    {
        try {
            $pages = HookAction::getProfilePages();
            
            // Sort pages by position
            $pages = $pages->sortBy('position');
            
            if ($slug) {
                $page = $pages->get($slug);
                
                if (!$page) {
                    throw new \Exception(__('Profile page not found'), 404);
                }
                
                $title = $page['title'];
                
                if ($callback = Arr::get($page, 'callback')) {
                    return app()->call("{$callback[0]}@{$callback[1]}", ['page' => $page]);
                }

                // Load dynamic data if available
                $pageData = [];
                if (isset($page['data']) && is_array($page['data'])) {
                    foreach ($page['data'] as $key => $value) {
                        try {
                            $pageData[$key] = $value instanceof \Closure ? $value() : $value;
                        } catch (\Exception $e) {
                            Log::error("Error loading profile page data: {$e->getMessage()}", [
                                'page' => $page['key'],
                                'data_key' => $key,
                                'error' => $e
                            ]);
                            $pageData[$key] = null;
                        }
                    }
                }

                return $this->view(
                    'theme::profile.index',
                    array_merge(
                        compact('title', 'pages', 'page'),
                        $pageData
                    )
                );
            }

            // Default profile page
            $title = trans('cms::app.profile');
            $page = [
                'title' => $title,
                'contents' => 'theme::profile.default',
                'key' => 'index',
                'position' => 1
            ];

            return $this->view(
                'theme::profile.index',
                compact('title', 'pages', 'page')
            );

        } catch (\Exception $e) {
            Log::error("Profile page error: {$e->getMessage()}", [
                'slug' => $slug,
                'error' => $e
            ]);

            if ($e->getCode() === 404) {
                abort(404, $e->getMessage());
            }
            
            abort(500, __('An error occurred while processing your request'));
        }
    }

    public function update(UpdateProfileRequest $request): JsonResponse|RedirectResponse
    {
        $user = $request->user();

        DB::transaction(
            function () use ($user, $request) {
                $update = $request->only(['name']);

                if ($password = $request->input('password')) {
                    $update['password'] = Hash::make($password);
                }

                $this->userRepository->update($update, $user->id);

                do_action('theme.profile.update', $user, $request->all());
            }
        );

        return $this->success(
            [
                'message' => trans('cms::message.update_successfully'),
            ]
        );
    }

    public function changePassword(Request $request)
    {
        $title = trans('cms::app.change_password');
        $user = UserResource::make($request->user())->toArray($request);
        $pages = HookAction::getProfilePages();
        
        $page = [
            'title' => $title,
            'contents' => 'theme::profile.change_password',
            'key' => 'change_password'
        ];

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

    public function notification()
    {
        global $jw_user;

        $title = trans('cms::app.profile');

        $user = $jw_user;

        $notifications = $user->notifications->toArray();

        return $this->view(
            'theme::profile.notification.index',
            compact(
                'title',
                'notifications',
                'user'
            )
        );
    }

    public function doChangePassword(ChangePasswordRequest $request): JsonResponse|RedirectResponse
    {
        $currentPassword = $request->post('current_password');
        $password = $request->post('password');
        $user = $request->user();

        if (!Hash::check($currentPassword, $user->password)) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => trans('cms::app.current_password_incorrect'),
                ]
            );
        }

        DB::transaction(fn() => $user->update(['password' => Hash::make($password)]));

        return $this->success(
            [
                'message' => trans('cms::app.change_password_successfully'),
            ]
        );
    }
}
