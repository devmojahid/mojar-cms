<?php

namespace Juzaweb\Multilang\Traits;

trait Relationship
{
    public function translations()
    {
        return $this->hasMany($this->getTranslationModelName(), $this->getTranslationRelationKey());
    }

    public function translation()
    {
        return $this->hasOne($this->getTranslationModelName(), $this->getTranslationRelationKey())
            ->where($this->getLocaleKey(), $this->locale());
    }
}