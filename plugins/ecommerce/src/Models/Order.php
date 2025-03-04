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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Traits\ResourceModel;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Juzaweb\CMS\Traits\UseMetaData;
use Juzaweb\Backend\Models\Post;

/**
 * Juzaweb\Ecommerce\Models\Order
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $status
 * @property string $code
 * @property string $token
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $country_code
 * @property int $quantity
 * @property string $total_price
 * @property string $total
 * @property string $discount
 * @property string|null $discount_codes
 * @property string|null $discount_target_type
 * @property int|null $payment_method_id
 * @property string $payment_method_name
 * @property string|null $notes
 * @property int $other_address
 * @property string $payment_status
 * @property string $delivery_status
 * @property int|null $user_id
 * @property int $site_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PaymentMethod|null $paymentMethod
 * @property-read User|null $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereAddress($value)
 * @method static Builder|Order whereCode($value)
 * @method static Builder|Order whereCountryCode($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeliveryStatus($value)
 * @method static Builder|Order whereDiscount($value)
 * @method static Builder|Order whereDiscountCodes($value)
 * @method static Builder|Order whereDiscountTargetType($value)
 * @method static Builder|Order whereEmail($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereKey($value)
 * @method static Builder|Order whereName($value)
 * @method static Builder|Order whereNotes($value)
 * @method static Builder|Order whereOtherAddress($value)
 * @method static Builder|Order wherePaymentMethodId($value)
 * @method static Builder|Order wherePaymentMethodName($value)
 * @method static Builder|Order wherePaymentStatus($value)
 * @method static Builder|Order wherePhone($value)
 * @method static Builder|Order whereQuantity($value)
 * @method static Builder|Order whereTotal($value)
 * @method static Builder|Order whereTotalPrice($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @method static Builder|Order whereToken($value)
 * @property-read string $payment_status_text
 * @property-read string $delivery_status_text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Juzaweb\Ecommerce\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Juzaweb\Ecommerce\Models\Product> $products
 * @property-read int|null $products_count
 * @method static Builder|Order whereFilter(array $params = [])
 * @method static Builder|Order whereSiteId($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use ResourceModel;
    use UseMetaData;

    protected $table = 'orders';

    protected $fillable = [
        'title',
        'type',
        'status',
        'code',
        'token',
        'name',
        'phone',
        'email',
        'address',
        'country_code',
        'quantity',
        'total_price',
        'total',
        'discount',
        'discount_codes',
        'discount_target_type',
        'payment_method_id',
        'payment_method_name',
        'payment_status',
        'delivery_status',
        'notes',
        'user_id',
        'site_id'
    ];

    protected string $fieldName = 'title';

    protected $appends = [
        'payment_status_text',
        'delivery_status_text'
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public const PAYMENT_STATUS_PENDING = 'pending';
    public const PAYMENT_STATUS_COMPLETED = 'completed';
    public const PAYMENT_STATUS_FAILED = 'failed';

    public const DELIVERY_STATUS_PENDING = 'pending';
    public const DELIVERY_STATUS_PROCESSING = 'processing';
    public const DELIVERY_STATUS_SHIPPED = 'shipped';
    public const DELIVERY_STATUS_DELIVERED = 'delivered';

    protected $casts = [
        'total_price' => 'float',
        'total' => 'float',
        'discount' => 'float',
        'quantity' => 'integer'
    ];

    public static function findByCode(string $code, array $columns = ['*']): null|static
    {
        return static::whereCode($code)->first($columns);
    }

    public static function findByToken(string $token, array $columns = ['*']): null|static
    {
        return static::whereToken($token)->first($columns);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'order_items',
            'order_id',
            'post_id',
            'id',
            'id'
        );
    }

    public function downloadableItems()
    {
        return $this->posts()->whereMeta('downloadable', 1);
    }

    public function isPaymentCompleted(): bool
    {
        return $this->payment_status == static::PAYMENT_STATUS_COMPLETED;
    }

    public function getPaymentStatusTextAttribute(): string
    {
        return match ($this->payment_status) {
            self::PAYMENT_STATUS_COMPLETED => trans('ecomm::content.completed'),
            self::PAYMENT_STATUS_FAILED => trans('ecomm::content.failed'),
            default => trans('ecomm::content.pending'),
        };
    }

    public function getDeliveryStatusTextAttribute(): string
    {
        return match ($this->delivery_status) {
            self::DELIVERY_STATUS_PROCESSING => trans('ecomm::content.processing'),
            self::DELIVERY_STATUS_SHIPPED => trans('ecomm::content.shipped'),
            self::DELIVERY_STATUS_DELIVERED => trans('ecomm::content.delivered'),
            default => trans('ecomm::content.pending'),
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->title)) {
                $model->title = "Order #{$model->code}";
            }
        });
    }

    protected function getMetaModel(): string 
    {
        return OrderMeta::class;
    }

    protected function getMetaForeignKey(): string
    {
        return 'order_id';
    }
}
