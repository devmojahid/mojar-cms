<?php

namespace Mojahid\Ecommerce\Models;

use Juzaweb\CMS\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Juzaweb\CMS\Models\User;

class Cart extends Model
{
    protected $table = 'ecomm_carts';
    protected $fillable = [
        'code',
        'items',
        'user_id',
        'discount',
        'discount_codes',
        'discount_target_type',
        'site_id'
    ];

    protected $casts = [
        'items' => 'array',
        'discount' => 'float',
        'discount_codes' => 'array',
        'site_id' => 'integer'
    ];

    protected $attributes = [
        'discount' => 0,
        'site_id' => 0
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
