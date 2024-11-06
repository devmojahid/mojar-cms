<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Contracts;

use Mojar\Backend\Models\Post;

/**
 * @see \Mojar\CMS\Support\Imports\PostImporter
 */
interface PostImporterContract
{
    public function setCreatedBy(int $createdBy): static;

    public function getCreatedBy(): ?int;

    public function setDownloadThumbnail(bool $downloadThumbnai): static;

    public function getDownloadThumbnail(): bool;

    public function setDownloadContentImages(bool $download): static;

    public function getDownloadContentImages(): bool;

    public function import(array $data, array $options = []): Post;
}
