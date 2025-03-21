<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Mojahid\Lms\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Juzaweb\Backend\Models\Comment;
use Juzaweb\Backend\Models\MenuItem;
use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Models\PostLike;
use Juzaweb\Backend\Models\PostMeta;
use Juzaweb\Backend\Models\PostRating;
use Juzaweb\Backend\Models\PostView;
use Juzaweb\Backend\Models\Resource;
use Juzaweb\Backend\Models\Taxonomy;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\OrderItem;


/**
 * Mojahid\Lms\Models\Course
 *
 * @property int $id
 * @property string $title
 * @property string|null $thumbnail
 * @property string $slug
 * @property string|null $description
 * @property string|null $content
 * @property string $status
 * @property int $views
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string $type
 * @property array|null $json_metas
 * @property array|null $json_taxonomies
 * @property int|null $site_id
 * @property float $rating
 * @property int $total_rating
 * @property int $total_comment
 * @property string|null $uuid
 * @property string $locale
 * @property-read Collection<int, Taxonomy> $categories
 * @property-read int|null $categories_count
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read User|null $createdBy
 * @property-read Collection<int, CourseTopic> $topics
 * @property-read int|null $topics_count
 * @property-read Collection<int, PostLike> $likes
 * @property-read int|null $likes_count
 * @property-read Collection<int, MenuItem> $menuItems
 * @property-read int|null $menu_items_count
 * @property-read Collection<int, PostMeta> $metas
 * @property-read int|null $metas_count
 * @property-read Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read Collection<int, Order> $orders
 * @property-read int|null $orders_count
 * @property-read Collection<int, PostView> $postViews
 * @property-read int|null $post_views_count
 * @property-read Collection<int, PostRating> $ratings
 * @property-read int|null $ratings_count
 * @property-read Collection<int, Resource> $resources
 * @property-read int|null $resources_count
 * @property-read Collection<int, Taxonomy> $tags
 * @property-read int|null $tags_count
 * @property-read Collection<int, Taxonomy> $taxonomies
 * @property-read int|null $taxonomies_count
 * @property-read User|null $updatedBy
 * @method static PostFactory factory($count = null, $state = [])
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static Builder|Course query()
 * @method static Builder|Course whereContent($value)
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereCreatedBy($value)
 * @method static Builder|Course whereDescription($value)
 * @method static Builder|Post whereFilter(array $params = [])
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course whereJsonMetas($value)
 * @method static Builder|Course whereJsonTaxonomies($value)
 * @method static Builder|Course whereLocale($value)
 * @method static Builder|Post whereMeta(string $key, array|string|int|null $value)
 * @method static Builder|Post whereMetaIn(string $key, array $values)
 * @method static Builder|Post wherePublish()
 * @method static Builder|Course whereRating($value)
 * @method static Builder|Post whereSearch(array $params)
 * @method static Builder|Course whereSiteId($value)
 * @method static Builder|Course whereSlug($value)
 * @method static Builder|Course whereStatus($value)
 * @method static Builder|Post whereTaxonomy(int $taxonomy)
 * @method static Builder|Post whereTaxonomyIn(array $taxonomies)
 * @method static Builder|Course whereThumbnail($value)
 * @method static Builder|Course whereTitle($value)
 * @method static Builder|Course whereTotalComment($value)
 * @method static Builder|Course whereTotalRating($value)
 * @method static Builder|Course whereType($value)
 * @method static Builder|Course whereUpdatedAt($value)
 * @method static Builder|Course whereUpdatedBy($value)
 * @method static Builder|Course whereUuid($value)
 * @method static Builder|Course whereViews($value)
 * @mixin Eloquent
 */
class Course extends Post
{
    public function topics(): HasMany
    {
        return $this->hasMany(CourseTopic::class, 'post_id', 'id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            OrderItem::getTableName(),
            'post_id',
            'order_id'
        )->wherePivot('type', 'courses');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(
            OrderItem::class,
            'post_id',
            'id'
        )->where('type', 'courses');
    }

    public function getTopics(): Collection
    {
        return $this->topics()->get();
    }

    // lesson relation with topic hasmanythrough
    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(
            CourseLesson::class,
            CourseTopic::class,
            'post_id',       // Foreign key on CourseTopic table (refers to Course)
            'course_topic_id', // Foreign key on CourseLesson table (refers to Topic)
            'id',            // Local key on Course table
            'id'             // Local key on CourseTopic table
        );
    }

    public function curriculumItems()
    {
        // This relationship serves as a base for retrieving all curriculum items
        // Currently this will only return lessons, but it can be expanded later
        return $this->lessons();
    }

    public function allItems(): Collection
    {
        return $this->topics()->with('lessons')->get();
    }
    // Mojahid\Lms\Models\Course::allItems must return a relationship instance.
    public function allItems2(): HasMany
    {
        // Instead of just returning topics, we need to return items with topic_id set
        // For now, we'll use the topics relation but in the resource we'll transform it
        return $this->hasMany(CourseTopic::class, 'post_id', 'id')->with('lessons');
    }
}
