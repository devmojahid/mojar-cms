<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Support\Manager;

use Illuminate\Support\Arr;
use Mojar\Backend\Models\Post;
use Mojar\Backend\Repositories\PostRepository;
use Mojar\CMS\Contracts\PostManagerContract;

class PostManager implements PostManagerContract
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(array $data, array $options = []): Post
    {
        $model = $this->postRepository->create($data);

        $model->syncTaxonomies($data);

        $meta = Arr::get($data, 'meta', []);

        $model->syncMetas($meta);

        return $model;
    }

    public function update(array $data, int $id, array $options = []): Post
    {
        $model = $this->postRepository->update($data, $id);

        $model->syncTaxonomies($data);

        if ($meta = Arr::get($data, 'meta', [])) {
            $model->syncMetas($meta);
        }

        return $model;
    }
}
