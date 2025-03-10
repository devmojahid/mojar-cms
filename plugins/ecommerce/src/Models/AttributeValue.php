<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Juzaweb\CMS\Models\Model;

/**
 * Juzaweb\Ecommerce\Models\AttributeValue
 *
 * @property int $id
 * @property string $value
 * @property string $value_type
 * @property int $attribute_id
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValueType($value)
 * @property-read Attribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereId($value)
 * @mixin \Eloquent
 */
class AttributeValue extends Model
{
    protected $table = 'attribute_values';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }
}
