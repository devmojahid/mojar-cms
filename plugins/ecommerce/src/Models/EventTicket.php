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

    protected $table = '_event_tickets';
    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
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
    ];

    public function event()
    {
        return $this->belongsTo(Post::class, 'event_id', 'id');
    }

    public static function findByEvent($eventId): EloquentModel|EventTicket|null
    {
        return self::where('event_id', $eventId)->orderBy('id', 'ASC')->first();
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'active' => 'Active',
            'inactive' => 'Inactive',
        };
    }
}
