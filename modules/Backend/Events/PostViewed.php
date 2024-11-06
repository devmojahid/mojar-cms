<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Backend\Events;

use Mojar\Backend\Models\Post;

class PostViewed
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
