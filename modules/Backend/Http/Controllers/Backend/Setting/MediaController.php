<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Backend\Http\Controllers\Backend\Setting;

use Illuminate\Contracts\View\View;
use Mojar\CMS\Contracts\HookActionContract as HookAction;
use Mojar\CMS\Http\Controllers\BackendController;

class MediaController extends BackendController
{
    public function __construct(protected HookAction $hookAction) {}

    public function index(): View
    {
        $title = trans('cms::app.media_setting.title');
        $postTypes = $this->hookAction->getPostTypes();
        $thumbnailDefaults = get_config('thumbnail_defaults', []);
        $thumbnailSizes = $this->hookAction->getThumbnailSizes()->toArray();

        return view(
            'cms::backend.setting.media',
            compact(
                'title',
                'postTypes',
                'thumbnailDefaults',
                'thumbnailSizes'
            )
        );
    }
}
