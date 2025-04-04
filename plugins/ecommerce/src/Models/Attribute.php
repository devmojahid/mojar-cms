<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Juzaweb\CMS\Models\Model;

/**
 * Juzaweb\Ecommerce\Models\Attribute
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Juzaweb\Ecommerce\Models\AttributeValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    protected $table = 'attributes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }
}
