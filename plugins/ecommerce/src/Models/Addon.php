<?php

namespace Mojahid\Ecommerce\Models;

use Juzaweb\CMS\Models\Model;

class Addon extends Model
{
    protected $table = 'ecomm_addons';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'version',
        'author',
        'author_email',
        'author_url',
        'enabled',
        'is_premium',
        'license_key',
        'license_email',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];
}
