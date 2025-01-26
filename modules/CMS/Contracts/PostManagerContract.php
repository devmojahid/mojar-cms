<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Contracts;

use Juzaweb\Backend\Models\Post;

/**
 * @see \Juzaweb\CMS\Support\Manager\PostManager
 */
interface PostManagerContract
{
    public function create(array $data, array $options = []): Post;

    public function update(array $data, int $id, array $options = []): Post;
}
