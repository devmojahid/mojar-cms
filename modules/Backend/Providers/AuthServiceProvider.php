<?php

namespace Mojar\Backend\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Mojar\Backend\Models\Post;
use Mojar\Backend\Models\Taxonomy;
use Mojar\CMS\Models\User;
use Mojar\Backend\Policies\PostPolicy;
use Mojar\Backend\Policies\TaxonomyPolicy;
use Mojar\Backend\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Taxonomy::class => TaxonomyPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(
            function ($user, $ability) {
                if ($user->isAdmin()) {
                    return true;
                }

                return null;
            }
        );

        ResetPassword::createUrlUsing(
            function ($notifiable, $token) {
                return config('app.frontend_url')
                    . "/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}";
            }
        );
    }
}
