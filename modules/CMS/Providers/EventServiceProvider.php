<?php

namespace Mojar\CMS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Mojar\Backend\Events\AfterPostSave;
use Mojar\Backend\Events\DumpAutoloadPlugin;
use Mojar\Backend\Listeners\ResizeThumbnailPostListener;
use Mojar\Backend\Listeners\SaveSeoMetaPost;
use Mojar\CMS\Events\EmailHook;
use Mojar\Backend\Events\PostViewed;
use Mojar\Backend\Listeners\CountViewPost;
use Mojar\CMS\Listeners\SendEmailHook;
use Mojar\Backend\Listeners\SendMailRegisterSuccessful;
use Mojar\Backend\Events\RegisterSuccessful;
use Mojar\Backend\Listeners\DumpAutoloadPluginListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EmailHook::class => [
            SendEmailHook::class,
        ],
        RegisterSuccessful::class => [
            SendMailRegisterSuccessful::class,
        ],
        PostViewed::class => [
            CountViewPost::class
        ],
        DumpAutoloadPlugin::class => [
            DumpAutoloadPluginListener::class,
        ],
        AfterPostSave::class => [
            SaveSeoMetaPost::class,
            ResizeThumbnailPostListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
