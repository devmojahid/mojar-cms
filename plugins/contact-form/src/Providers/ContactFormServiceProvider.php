<?php

namespace Mojahid\ContactForm\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Mojahid\ContactForm\Actions;
use Mojahid\ContactForm\Repositories;

class ContactFormServiceProvider extends ServiceProvider
{
    public array $bindings = [
        Repositories\ContactRepository::class => Repositories\ContactRepositoryEloquent::class,
    ];

    public function boot(): void
    {
        $this->registerHookActions([Actions\MenuAction::class, Actions\AjaxAction::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
