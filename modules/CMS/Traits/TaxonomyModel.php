<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Juzaweb\Backend\Models\TaxonomyMeta;
use Juzaweb\CMS\Facades\HookAction;

trait TaxonomyModel
{
    use UseSlug;
    use UseThumbnail;
    use ResourceModel;

    public static function bootTaxonomyModel(): void
    {
        static::saving(
            function ($model) {
                $model->setAttribute('level', $model->getLevel());
            }
        );
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function recursiveParents(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->parent()->with('recursiveParents');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function recursiveChildren(): HasMany
    {
        return $this->children()->with('recursiveChildren');
    }

    public function posts($postType = null): BelongsToMany
    {
        $postType = $postType ?: $this->getPostType('key');
        $postModel = $this->getPostType('model');

        return $this->belongsToMany($postModel, 'term_taxonomies', 'taxonomy_id', 'term_id')
            ->withPivot(['term_type'])
            ->wherePivot('term_type', '=', $postType);
    }

    /**
     * @param Builder $builder
     * @param array $params
     *
     * @return Builder
     */
    public function scopeWhereFilter($builder, $params = [])
    {
        if ($taxonomy = Arr::get($params, 'taxonomy')) {
            $builder->where('taxonomy', '=', $taxonomy);
        }

        if ($postType = Arr::get($params, 'post_type')) {
            $builder->where('post_type', '=', $postType);
        }

        if ($keyword = Arr::get($params, 'keyword')) {
            $builder->where(
                function (Builder $q) use ($keyword) {
                    $q->where('name', JW_SQL_LIKE, '%' . $keyword . '%');
                    $q->orWhere('description', JW_SQL_LIKE, '%' . $keyword . '%');
                }
            );
        }

        if ($metas = Arr::get($params, 'meta')) {
            foreach ($metas as $key => $val) {
                if (is_null($metas[$key])) {
                    continue;
                }

                $builder->whereMeta($key, $val);
            }
        }


        return $builder;
    }

    public function getPostType($key = null)
    {
        $postType = HookAction::getPostTypes($this->post_type);
        if ($key) {
            return $postType->get($key);
        }

        return $postType;
    }

    public function getPermalink($key = null)
    {
        $permalink = HookAction::getPermalinks($this->taxonomy);

        if (empty($permalink)) {
            return false;
        }

        if (empty($key)) {
            return $permalink;
        }

        return $permalink->get($key);
    }

    public function getLink()
    {
        $permalink = $this->getPermalink('base');
        if (empty($permalink)) {
            return false;
        }

        return url()->to($permalink . '/' . $this->slug);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLevel(): int
    {
        $level = 0;
        recursive_level_model($level, $this);

        return $level;
    }

    public function metas(): HasMany
    {
        return $this->hasMany(TaxonomyMeta::class, 'taxonomy_id', 'id');
    }

    public function getMeta($key, $default = null): mixed
    {
        return $this->json_metas[$key] ?? $default;
    }

    public function getMetas(): ?array
    {
        return $this->json_metas;
    }

    public function scopeWhereMeta(Builder $builder, string $key, string|array|int $value): Builder
    {
        return $builder->whereHas(
            'metas',
            function (Builder $q) use ($key, $value) {
                $q->where('meta_key', '=', $key);
                if (is_array($value)) {
                    $q->whereIn('meta_value', $value);
                } else {
                    $q->where('meta_value', '=', $value);
                }
            }
        );
    }

    public function scopeWhereMetaIn($builder, $key, $values)
    {
        return $builder->whereHas(
            'metas',
            function (Builder $q) use ($key, $values) {
                $q->where('meta_key', '=', $key);
                $q->whereIn('meta_value', $values);
            }
        );
    }

    public function scopeWhereMetaNot($builder, $key, $value)
    {
        return $builder->whereHas(
            'metas',
            function (Builder $q) use ($key, $value) {
                $q->where('meta_key', '=', $key);
                $q->where('meta_value', '!=', $value);
            }
        );
    }

    public function setMeta($key, $value): void
    {
        $metas = $this->getMetas();
        $this->metas()->updateOrCreate(
            [
                'meta_key' => $key
            ],
            [
                'meta_value' => is_array($value) ? json_encode($value) : $value
            ]
        );

        $metas[$key] = $value;

        $this->update(
            [
                'json_metas' => $metas
            ]
        );
    }

    // public function deleteMeta($key): bool
    // {
    //     $this->metas()->where('meta_key', $key)->delete();

    //     return true;
    // }

    public function deleteMeta($key): bool
    {
        $this->metas()->where('meta_key', $key)->delete();

        $metas = $this->getMetas();

        unset($metas[$key]);

        $this->update(
            [
                'json_metas' => $metas
            ]
        );

        return true;
    }

    public function deleteMetas(array $keys): bool
    {
        $this->metas()->whereIn('meta_key', $keys)->delete();

        $metas = $this->getMetas();

        foreach ($keys as $key) {
            unset($metas[$key]);
        }

        $this->update(
            [
                'json_metas' => $metas
            ]
        );

        return true;
    }

    public function syncMetas(array $data = []): void
    {
        $this->syncMetasWithoutDetaching($data);

        $this->metas()->whereNotIn('meta_key', array_keys($data))->delete();
    }

    public function syncMetasWithoutDetaching(array $data = []): void
    {
        $metas = $this->json_metas;

        foreach ($data as $key => $val) {
            $this->metas()->updateOrCreate(
                [
                    'meta_key' => $key
                ],
                [
                    'meta_value' => is_array($val) ? json_encode($val) : $val
                ]
            );

            $metas[$key] = $val;
        }

        $this->update(
            [
                'json_metas' => $metas
            ]
        );
    }
}
