<?php

namespace Mojahid\Ecommerce\Models;

use Juzaweb\CMS\Models\Model;

class Currency extends Model
{
    protected $table = 'ecomm_currencies';
    protected $fillable = [
        'code',
        'symbol',
        'exchange_rate',
        'is_default',
        'is_enabled',
        'name',
        'symbol_position',
        'thousand_separator',
        'decimal_separator',
        'decimal_place',
        'decimal_point',
        'currency_format',
        'custom_price_format',
    ];

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
    
}
