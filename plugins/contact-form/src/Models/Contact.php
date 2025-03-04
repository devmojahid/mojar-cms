<?php

namespace Mojahid\ContactForm\Models;

use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Traits\UUIDPrimaryKey;

class Contact extends Model
{
    use ResourceModel, UUIDPrimaryKey;

    protected $table = 'contact_form_contacts';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    protected $casts = [
        'metas' => 'array',
    ];

    public function metas(): array
    {
        return $this->metas ?? [];
    }

    public function setMeta(string $key, string|array $value): void
    {
        $this->metas[$key] = $value;
    }

    public function getMeta(string $key, null|string|array $default = null): string|array
    {
        return $this->metas[$key] ?? $default;
    }
}
