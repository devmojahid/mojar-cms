<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Contracts;

interface BackendMessageContract
{
    public function all(): array;

    public function add(string $group, array|string $message, string $status): void;

    public function delete(string $id): bool;

    public function deleteGroup(string $group): bool;
}
