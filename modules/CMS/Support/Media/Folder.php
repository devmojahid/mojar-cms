<?php

namespace Mojar\CMS\Support\Media;

use Illuminate\Contracts\Filesystem\Filesystem;
use Mojar\CMS\Interfaces\Media\FolderInterface;

class Folder implements FolderInterface
{
    protected string $path;
    protected Filesystem $disk;

    public function __construct(string $path, Filesystem $disk)
    {
        $this->path = $path;
        $this->disk = $disk;
    }

    public function path(): string
    {
        return $this->disk->path($this->path);
    }
}
