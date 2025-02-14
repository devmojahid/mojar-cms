<?php

namespace Mojahid\Ecommerce\Models;

use Juzaweb\CMS\Models\Model;

/**
 * Mojahid\Ecommerce\Models\VariantNameItem
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VariantNameItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantNameItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantNameItem query()
 * @mixin \Eloquent
 */
class VariantNameItem extends Model
{
    public $timestamps = false;

    protected $table = 'variant_name_items';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
