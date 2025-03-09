<?php

namespace Mojahid\EdufaxHelper\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Version;

class EdufaxHelperAction extends Action
{
    /**
     * Handle all the actions and filters for the theme helper.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'registerAjaxRoutes']);
    }

    /**
     * Register frontend assets for the plugin.
     *
     * @return void
     */
    public function registerFrontendAssets(): void
    {
        HookAction::enqueueScript('edufax-helper-scripts', plugin_asset('edufax-helper', 'js/post-filter.js'), $ver);
        HookAction::enqueueStyle('edufax-helper-styles', plugin_asset('edufax-helper', 'css/post-filter.css'), $ver);
    }

    /**
     * Register custom AJAX routes used by the theme.
     *
     * @return void
     */
    public function registerAjaxRoutes(): void
    {
        // AJAX route registration can be done in the routes/web.php file
        // This method can be used for any additional route setup if needed
    }
} 