<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Mojar\CMS\Traits;

use Illuminate\Support\Str;

trait UseUUIDColumn
{
    public static function generateUniqueUUID(): string
    {
        do {
            $uuid = Str::uuid()->toString();
        } while (static::withoutGlobalScopes()->where('uuid', $uuid)->exists());

        return $uuid;
    }

    protected static function bootUseUUIDColumn(): void
    {
        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(
            function ($model) {
                if ($model->getKey() === null) {
                    $model->setAttribute('uuid', static::generateUniqueUUID());
                }
            }
        );
    }
}
