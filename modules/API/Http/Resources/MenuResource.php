<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Mojar\API\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mojar\Backend\Models\Menu;

/**
 * @property Menu $resource
 */
class MenuResource extends JsonResource
{
    public function toArray($request): array
    {
        $this->resource->load(
            [
                'items.recursiveChildren' => fn($q) => $q->cacheFor(
                    config('mojar.performance.query_cache.lifetime')
                )
            ]
        );

        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'location' => $this->resource->getLocation(),
            'items' => MenuItemCollection::make($this->resource->items),
        ];
    }
}
