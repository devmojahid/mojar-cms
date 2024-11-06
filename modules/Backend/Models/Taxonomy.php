<?php

namespace Mojar\Backend\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mojar\CMS\Database\Factories\TaxonomyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mojar\CMS\Traits\QueryCache\QueryCacheable;
use Mojar\CMS\Traits\TaxonomyModel;
use Mojar\CMS\Models\Model;
use Mojar\CMS\Traits\UseUUIDColumn;

/**
 * Mojar\Backend\Models\Taxonomy
 *
 * @property int $id
 * @property string $name
 * @property string|null $thumbnail
 * @property string|null $description
 * @property string $slug
 * @property string $post_type
 * @property string $taxonomy
 * @property int|null $parent_id
 * @property int $total_post
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $level
 * @property-read \Illuminate\Database\Eloquent\Collection|Taxonomy[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Mojar\Backend\Models\MenuItem[] $menuItems
 * @property-read int|null $menu_items_count
 * @property-read Taxonomy|null $parent
 * @method static \Mojar\CMS\Database\Factories\TaxonomyFactory factory(...$parameters)
 * @method static Builder|Taxonomy newModelQuery()
 * @method static Builder|Taxonomy newQuery()
 * @method static Builder|Taxonomy query()
 * @method static Builder|Taxonomy whereCreatedAt($value)
 * @method static Builder|Taxonomy whereDescription($value)
 * @method static Builder|Taxonomy whereFilter($params = [])
 * @method static Builder|Taxonomy whereId($value)
 * @method static Builder|Taxonomy whereLevel($value)
 * @method static Builder|Taxonomy whereName($value)
 * @method static Builder|Taxonomy whereParentId($value)
 * @method static Builder|Taxonomy wherePostType($value)
 * @method static Builder|Taxonomy whereSlug($value)
 * @method static Builder|Taxonomy whereTaxonomy($value)
 * @method static Builder|Taxonomy whereThumbnail($value)
 * @method static Builder|Taxonomy whereTotalPost($value)
 * @method static Builder|Taxonomy whereUpdatedAt($value)
 * @property int|null $site_id
 * @method static Builder|Taxonomy whereSiteId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Taxonomy[] $recursiveChildren
 * @property-read int|null $recursive_children_count
 * @property string|null $uuid
 * @method static Builder|Taxonomy whereUuid($value)
 * @property-read Taxonomy|null $recursiveParents
 * @mixin \Eloquent
 */
class Taxonomy extends Model
{
    protected static bool $flushCacheOnUpdate = true;

    use TaxonomyModel, HasFactory, QueryCacheable, UseUUIDColumn;

    protected $table = 'taxonomies';

    protected string $slugSource = 'name';

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'slug',
        'taxonomy',
        'post_type',
        'parent_id',
        'total_post',
    ];

    public string $cachePrefix = 'taxonomies_';

    /**
     * Create Builder for frontend
     *
     * @return Builder
     */
    public static function selectFrontendBuilder(): Builder
    {
        return self::query();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return TaxonomyFactory::new();
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(
            MenuItem::class,
            'model_id',
            'id'
        )
            ->where(
                'model_class',
                '=',
                'Mojar\\Models\\Taxonomy'
            );
    }

    protected function getCacheBaseTags(): array
    {
        return [
            'taxonomies',
        ];
    }
}
