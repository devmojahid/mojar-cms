<?php

namespace Juzaweb\CMS\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait UseMetaData
{
    protected $metaData = [];

    public function metas(): HasMany
    {
        return $this->hasMany($this->getMetaModel(), $this->getMetaForeignKey(), 'id');
    }

    public function getMeta(string $key, $default = null): mixed
    {
        if (isset($this->json_metas) && array_key_exists($key, $this->json_metas)) {
            return $this->json_metas[$key];
        }

        if (!empty($this->metaData[$key])) {
            return $this->metaData[$key];
        }

        $value = $this->metas()
            ->where('meta_key', '=', $key)
            ->first(['meta_value']);

        $this->metaData[$key] = $value?->meta_value;

        return $value?->meta_value ?? $default;
    }

    public function setMeta(string $key, $value): void
    {
        $meta = $this->metas()
            ->updateOrCreate(
                ['meta_key' => $key],
                ['meta_value' => $value]
            );

        $this->metaData[$key] = $meta->meta_value;
    }

    public function syncMetas(array $metas): void
    {
        $this->metas()->delete();
        
        foreach ($metas as $key => $value) {
            $this->setMeta($key, $value);
        }
    }

    public function syncMetasWithoutDetaching(array $metas): void
    {
        foreach ($metas as $key => $value) {
            $this->setMeta($key, $value);
        }
    }

    protected function getMetaModel(): string
    {
        return str_replace('Model', 'MetaModel', get_class($this));
    }

    protected function getMetaForeignKey(): string
    {
        return Str::snake(class_basename($this)) . '_id';
    }
} 