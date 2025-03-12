<?php

namespace Mojahid\Lms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Juzaweb\Backend\Models\Post;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\QueryCache\QueryCacheable;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Traits\PostTypeModel;
use Juzaweb\CMS\Traits\UseUUIDColumn;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * Mojahid\Lms\Models\CourseTopic
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $thumbnail
 * @property string|null $description
 * @property string $status
 * @property int $order
 * @property int $post_id
 * @property-read Post $topic
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereUpdatedAt($value)
 * @property int $site_id
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereFilter(array $params = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseTopic whereSiteId($value)
 * @mixin \Eloquent
 */
class CourseTopic extends Model
{
    use PostTypeModel, HasFactory, ResourceModel, QueryCacheable {
        // Use PostTypeModel's implementation instead of ResourceModel's
        PostTypeModel::getStatuses insteadof ResourceModel;
        PostTypeModel::scopeWhereFilter insteadof ResourceModel;
    }

    public string $cachePrefix = 'lms_course_topics_';

    protected $table = 'lms_course_topics';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'status',
        'order',
        'post_id',
    ];

    protected string $fieldName = 'title';

    public static function findByTopic($topicId): EloquentModel|CourseTopic|null
    {
        return self::where('post_id', '=', $topicId)
            ->orderBy('id', 'ASC')
            ->first();
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function getThumbnail(): ?string
    {
        if ($this->thumbnail) {
            return $this->thumbnail;
        }

        return $this->topic->thumbnail;
    }

    protected function getCacheBaseTags(): array
    {
        return [
            'lms_course_topics',
        ];
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(CourseLesson::class, 'course_topic_id', 'id');
    }
}
