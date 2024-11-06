<?php

namespace Mojar\Backend\Http\Controllers\Backend;

use Mojar\CMS\Http\Controllers\BackendController;
use Mojar\Backend\Models\Post;
use Mojar\CMS\Traits\PostTypeController;

class PostController extends BackendController
{
    use PostTypeController;

    protected string $viewPrefix = 'cms::backend.post';

    protected function getModel(...$params): string
    {
        return Post::class;
    }
}
