<?php

namespace Mojar\Backend\Models;

use Mojar\CMS\Models\Model;

/**
 * Mojar\Backend\Models\PostView
 *
 * @property int $id
 * @property int $post_id
 * @property int $views
 * @property string $day
 * @property-read \Mojar\Backend\Models\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereViews($value)
 * @property int|null $site_id
 * @mixin \Eloquent
 */
class PostView extends Model
{
    protected $table = 'post_views';
    protected $fillable = [
        'views',
        'day',
        'post_id',
    ];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
