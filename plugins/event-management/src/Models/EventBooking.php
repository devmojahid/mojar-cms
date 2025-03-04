<?php

namespace Mojahid\EventManagement\Models;

use Juzaweb\CMS\Models\Model;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Juzaweb\CMS\Models\User;
use Juzaweb\Backend\Models\Post;
use Mojahid\EventManagement\Models\EventTicket;
use Juzaweb\CMS\Traits\ResourceModel;

class EventBooking extends Model
{
    use ResourceModel;

    public const PAYMENT_STATUS_PENDING = 'pending';
    public const PAYMENT_STATUS_PROCESSING = 'processing';
    public const PAYMENT_STATUS_COMPLETED = 'completed';
    public const PAYMENT_STATUS_FAILED = 'failed';
    public const PAYMENT_STATUS_REFUNDED = 'refunded';
    public const PAYMENT_STATUS_CANCELLED = 'cancelled';
    public const PAYMENT_STATUS_EXPIRED = 'expired';


    protected $table = 'evman_event_bookings';
    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'status',
        'payment_method_id',
        'payment_status',
        'order_id',
        'quantity',
        'code',
        'booking_date',
        'notes',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function isPaymentCompleted(): bool
    {
        return $this->payment_status == static::PAYMENT_STATUS_COMPLETED;
    }

    public function getPaymentStatusTextAttribute(): string
    {
        return match ($this->payment_status) {
            static::PAYMENT_STATUS_COMPLETED => trans('ecomm::content.completed'),
            default => trans('ecomm::content.pending'),
        };
    }

    public function isPaymentFailed(): bool
    {
        return $this->payment_status == static::PAYMENT_STATUS_FAILED;
    }

    public function event()
    {
        return $this->belongsTo(Post::class, 'event_id');
    }

    public function ticket()
    {
        return $this->belongsTo(EventTicket::class, 'ticket_id');
    }

    public function generateCode(): string
    {
        return 'EVT-' . strtoupper(uniqid());
    }

    public static function findByCode(string $code): ?self
    {
        return static::where('code', $code)->first();
    }

    public function order()
    {
        return $this->belongsTo(\Mojahid\Ecommerce\Models\Order::class, 'order_id');
    }
}


