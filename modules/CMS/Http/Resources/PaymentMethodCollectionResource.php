<?php
/**
 * Mojar CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://mojar.com
 * @license    MIT
 */


 namespace Juzaweb\CMS\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentMethodCollectionResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(
            function ($item) {
                return array_only(
                    $item->toArray(),
                    [
                        'id',
                        'type',
                        'name',
                        'description',
                    ]
                );
            }
        )->toArray();
    }
}
