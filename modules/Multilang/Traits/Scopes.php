<?php

namespace Juzaweb\Multilang\Traits;

trait Scopes
{
    public function scopeTranslatedIn($query, $locale)
    {
        return $query->whereHas('translations', function ($query) use ($locale) {
            $query->where($this->getLocaleKey(), '=', $locale);
        });
    }

    public function scopeNotTranslatedIn($query, $locale)
    {
        return $query->whereDoesntHave('translations', function ($query) use ($locale) {
            $query->where($this->getLocaleKey(), '=', $locale);
        });
    }
}