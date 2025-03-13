<?php

namespace Mojahid\Lms\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Juzaweb\Backend\Models\Post;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\QueryCache\QueryCacheable;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Traits\PostTypeModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Mojahid\Lms\Models\CourseLesson
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $thumbnail
 * @property string|null $description
 * @property string $status
 * @property int $order
 * @property int $post_id
 * @property int $course_topic_id
 * @property string $type
 * @property int $duration
 * @property array $metas
 * @property-read Post $topic
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereUpdatedAt($value)
 * @property int $site_id
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereFilter(array $params = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLesson whereSiteId($value)
 * @mixin \Eloquent
 */
class CourseLesson extends Model
{
    use PostTypeModel, HasFactory, ResourceModel, QueryCacheable {
        PostTypeModel::getStatuses insteadof ResourceModel;
        PostTypeModel::scopeWhereFilter insteadof ResourceModel;
    }


    public string $cachePrefix = 'lms_course_lessons_';

    protected $table = 'lms_course_lessons';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'status',
        'order',
        'post_id',
        'course_topic_id',
        'type',
        'duration',
        'metas',
    ];

    protected $casts = [
        'metas' => 'array',
    ];

    protected string $fieldName = 'title';

    public static function findByLesson($lessonId): EloquentModel|CourseLesson|null
    {
        return self::where('post_id', '=', $lessonId)
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
            'lms_course_lessons',
        ];
    }
}
