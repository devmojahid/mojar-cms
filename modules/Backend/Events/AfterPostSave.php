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

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Mojar\Backend\Models\Post;

class AfterPostSave
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Post $post;

    public array $data;

    public function __construct(Post $post, array $data)
    {
        $this->post = $post;
        $this->data = $data;
    }
}
