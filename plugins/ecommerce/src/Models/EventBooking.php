<?php

namespace Mojahid\EventManagement\Models;

use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Models\PaymentMethod;
use Juzaweb\CMS\Models\User;
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


    protected $table = '_event_bookings';
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
    

}


