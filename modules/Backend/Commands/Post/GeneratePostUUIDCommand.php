<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojar\Backend\Commands\Post;

use Illuminate\Console\Command;
use Mojar\Backend\Models\Post;

class GeneratePostUUIDCommand extends Command
{
    protected $name = 'posts:generate-uuid-missing';

    protected $description = 'Generate post uuid missing command.';

    public function handle(): void
    {
        Post::whereNull('uuid')->get()->each(
            fn($post) => $this->generateUUID($post)
        );
    }

    protected function generateUUID(Post $post): void
    {
        $post->setAttribute('uuid', Post::generateUniqueUUID());
        $post->save();

        $this->info("Generated for post {$post->id}");
    }
}
