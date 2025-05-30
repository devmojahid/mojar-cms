<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\UseMetaData;
use Juzaweb\Backend\Models\Post;

/**
 * Juzaweb\Ecommerce\Models\OrderItem
 *
 * @property int $id
 * @property string $title
 * @property string|null $thumbnail
 * @property string $price
 * @property string $line_price
 * @property int $quantity
 * @property string|null $compare_price
 * @property string|null $sku_code
 * @property string|null $barcode
 * @property int $order_id
 * @property int|null $product_id
 * @property int|null $variant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product|null $product
 * @method static Builder|OrderItem newModelQuery()
 * @method static Builder|OrderItem newQuery()
 * @method static Builder|OrderItem query()
 * @method static Builder|OrderItem whereBarcode($value)
 * @method static Builder|OrderItem whereComparePrice($value)
 * @method static Builder|OrderItem whereCreatedAt($value)
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereLinePrice($value)
 * @method static Builder|OrderItem whereOrderId($value)
 * @method static Builder|OrderItem wherePrice($value)
 * @method static Builder|OrderItem whereProductId($value)
 * @method static Builder|OrderItem whereQuantity($value)
 * @method static Builder|OrderItem whereSkuCode($value)
 * @method static Builder|OrderItem whereThumbnail($value)
 * @method static Builder|OrderItem whereTitle($value)
 * @method static Builder|OrderItem whereUpdatedAt($value)
 * @method static Builder|OrderItem whereVariantId($value)
 * @mixin Eloquent
 */
class OrderItem extends Model
{
    use UseMetaData;

    protected $table = 'order_items';

    protected $fillable = [
        'title',
        'type',
        'thumbnail',
        'price',
        'line_price',
        'quantity',
        'compare_price',
        'sku_code',
        'barcode',
        'order_id',
        'post_id'
    ];

    protected $casts = [
        'price' => 'float',
        'line_price' => 'float',
        'compare_price' => 'float',
        'quantity' => 'integer'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->type)) {
                $model->type = 'product';
            }
        });
    }
}
