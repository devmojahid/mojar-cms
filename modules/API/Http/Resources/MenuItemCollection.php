<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\API\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuItemCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            function ($item) {
                $result = [
                    'id' => $item->id,
                    'label' => $item->label,
                    'link' => $item->link,
                    'type' => $item->type,
                    'icon' => $item->icon,
                    'target' => $item->target,
                    'num_order' => $item->num_order,
                ];

                if ($item->recursiveChildren->isNotEmpty()) {
                    $result['children'] = MenuItemCollection::make($item->recursiveChildren);
                }

                return $result;
            }
        )->toArray();
    }
}
