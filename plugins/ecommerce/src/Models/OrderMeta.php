<?php

namespace Mojahid\Ecommerce\Models;

use Juzaweb\CMS\Models\Model;

class OrderMeta extends Model
{
    protected $table = 'order_metas';

    protected $fillable = [
        'order_id',
        'meta_key',
        'meta_value'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
} 