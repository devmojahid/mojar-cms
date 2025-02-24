<?php

namespace Mojahid\EventManagement\Models;

use Juzaweb\CMS\Models\Model;
use Juzaweb\Backend\Models\Post;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Traits\ResourceModel;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Juzaweb\CMS\Traits\QueryCacheable;

class EventTicket extends Model
{
    use ResourceModel;

    public string $cachePrefix = 'event_tickets_';

    protected $table = 'evman_event_tickets';
    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
        'status',
        'min_ticket_number',
        'max_ticket_number',
        'start_date',
        'end_date',
        'event_id',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'float'
    ];

    public function event()
    {
        return $this->belongsTo(Post::class, 'event_id');
    }

    public static function findByEvent($eventId): EloquentModel|EventTicket|null
    {
        return self::where('event_id', $eventId)->orderBy('id', 'ASC')->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(EventBooking::class, 'ticket_id');
    }

    public function getBookedCount(): int
    {
        return $this->bookings()
            ->whereIn('payment_status', [
                EventBooking::PAYMENT_STATUS_COMPLETED,
                EventBooking::PAYMENT_STATUS_PROCESSING
            ])
            ->sum('quantity');
    }

    public function isAvailable(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->start_date && now() < $this->start_date) {
            return false;
        }

        if ($this->end_date && now() > $this->end_date) {
            return false;
        }

        if ($this->capacity && $this->getBookedCount() >= $this->capacity) {
            return false;
        }

        return true;
    }

    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'active' => 'Active',
            'inactive' => 'Inactive',
        };
    }
}
