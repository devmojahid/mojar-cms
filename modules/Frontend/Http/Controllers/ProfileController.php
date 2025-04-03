<?php

namespace Juzaweb\Frontend\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Juzaweb\Backend\Http\Resources\UserResource;
use Juzaweb\Backend\Repositories\UserRepository;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Juzaweb\Frontend\Http\Requests\ChangePasswordRequest;
use Juzaweb\Frontend\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Juzaweb\CMS\Support\FileManager;

class ProfileController extends FrontendController
{
    public function __construct(protected UserRepository $userRepository) {}

    public function index($slug = null)
    {
        $pages = HookAction::getProfilePages();
        global $jw_user;

        $user = $jw_user;

        if ($slug) {
            $page = $pages->where('key', $slug)->first();

            if (!$page) {
                $title = trans('cms::app.profile');
                $page = [
                    'title' => $title,
                    'contents' => 'theme::profile.default'
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

            $title = $page['title'];

            if ($callback = Arr::get($page, 'callback')) {
                return app()->call("{$callback[0]}@{$callback[1]}", ['page' => $page]);
            }

            if ($page['key'] == 'logout') {
                return $this->logout();
            }

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

        // Default profile page
        $title = trans('cms::app.profile');
        $page = [
            'title' => $title,
            'contents' => 'theme::profile.default'
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

    public function update(UpdateProfileRequest $request): JsonResponse|RedirectResponse
    {
        $user = $request->user();
        
        // Extract allowed fields from request
        $userData = $request->only(['name', 'phone', 'avatar']);
        
        // Extract meta data with null check
        $metasInput = $request->post('metas') ?? [];
        $metas = array_only($metasInput, ['birthday', 'country', 'address', 'city', 'state', 'zip_code', 'bio', 'phone']);
        
        DB::beginTransaction();
        try {
            // Handle password update if provided
            if ($password = $request->input('password')) {
                $userData['password'] = Hash::make($password);
            }

            // if ($request->hasFile('avatar')) {
            //      $userData['avatar'] = $this->handleAvatarUpload($request->file('avatar'));
            // } elseif ($request->input('avatar')) {
            //      $userData['avatar'] = $request->input('avatar');
            // }

            if ($request->hasFile('avatar')) { // This will be the original file input field
                try {
                    // Use your FileManager to process the file
                    $avatar = FileManager::addFile(
                        $request->file('avatar'), // Pass the uploaded file
                        'image',                       // Type
                        null,                          // Additional params if needed
                        $user->id                  // User ID
                    );
                    
                    // Set the avatar path from the FileManager response
                    $userData['avatar'] = $avatar->path;
                } catch (\Exception $e) {
                    // Handle error
                    $userData['avatar'] = null;
                    // Log error
                    \Log::error('Avatar upload failed: ' . $e->getMessage());
                }
            }
            
            // Update user data
            $this->userRepository->update($userData, $user->id);
            
            // Update meta data
            foreach ($metas as $key => $value) {
                $user->setMeta($key, $value);
            }
            
            // Execute theme hooks
            do_action('theme.profile.update', $user, $request->all());
            
            DB::commit();
            
            return $this->success([
                'message' => trans('cms::message.update_successfully'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateOld(UpdateProfileRequest $request): JsonResponse|RedirectResponse
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
            'key' => 'change_password',
        ];

        return $this->view(
            'theme::profile.index',
            compact(
                'title',
                'pages',
                'page',
                'user',
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

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->to('/');
    }
}
