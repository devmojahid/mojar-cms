<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductVariantCollectionResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(
            function ($item) {
                return [
                    'sku_code' => $item->sku_code,
                    'barcode' => $item->barcode,
                    'title' => $item->title,
                    'thumbnail' => $item->thumbnail,
                    'description' => $item->description,
                    'names' => $item->names,
                    'images' => $item->images,
                    'price' => $item->sku_code,
                    'compare_price' => $item->compare_price,
                    'stock' => $item->stock,
                    'type' => $item->type,
                    'line_price' => ecom_price_with_unit($item->line_price),
                ];
            }
        )->toArray();
    }
}
