<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Mojar\CMS\Models\UserMeta
 *
 * @property int $id
 * @property int $user_id
 * @property string $meta_key
 * @property string|null $meta_value
 * @property-read \Mojar\CMS\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMeta whereUserId($value)
 * @mixin \Eloquent
 */
class UserMeta extends Model
{
    public $timestamps = false;

    protected $table = 'user_metas';

    protected $fillable = [
        'user_id',
        'meta_key',
        'meta_value'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
