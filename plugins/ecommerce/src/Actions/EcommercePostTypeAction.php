<?php

namespace Mojahid\Ecommerce\Actions;

use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Models\DownloadLink;
use Mojahid\Ecommerce\Models\Product;
use Mojahid\Ecommerce\Models\ProductVariant;
use Juzaweb\Backend\Models\Post;
use Mojahid\Ecommerce\Http\Resources\ProductVariantResource;

class EcommercePostTypeAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );
        
        $this->addAction(
            'post_type.products.form.left',
            [$this, 'addFormProduct']
        );

        $this->addFilter(
            'post_type.products.parseDataForSave',
            [$this, 'parseDataForSave']
        );
        
        $this->addAction(
            "post_type.products.after_save",
            [$this, 'saveDataProduct'],
            20,
            2
        );

        $this->addFilter('post.withFrontendDetailBuilder', [$this, 'addWithVariantsProductDetail']);

        $this->addFilter('jw.resource.post.products', [$this, 'addVariantsProductDetail'], 20, 2);
    }

    /**
     * Register post types
    */
    public function registerPostTypes(): void
    {
        $productInvisibleMetas = [
            'price',
            'sku_code',
            'barcode',
            'quantity',
            'inventory_management',
            'disable_out_of_stock',
            'downloadable',
        ];

        HookAction::registerPostType(
            'products',
            [
                'label' => trans('ecomm::content.products'),
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'category',
                    'tag'
                ],
                'metas' => collect($productInvisibleMetas)
                    ->mapWithKeys(
                        fn ($item) => [$item => ['visible' => false]]
                    )
                    ->toArray(),
            ]
        );

        HookAction::registerTaxonomy(
            'brands',
            'products',
            [
                'label' => trans('ecomm::content.brands'),
                'menu_position' => 11,
            ]
        );

        HookAction::registerTaxonomy(
            'vendors',
            'products',
            [
                'label' => trans('ecomm::content.vendors'),
                'menu_position' => 12,
            ]
        );
    }

    public function addFormProduct($model): void
    {
        $variant = ProductVariant::findByProduct($model->id);
        if ($variant === null) {
            $variant = new ProductVariant();
        }

        echo e(
            view(
                'ecomm::backend.product.form',
                compact(
                    'variant',
                    'model'
                )
            )
        );
    }

    public function parseDataForSave($data)
    {
        $metas = (array) $data['meta'];
        if ($metas['price']) {
            $metas['price'] = parse_price_format($metas['price']);
        }

        if ($metas['compare_price']) {
            $metas['compare_price'] = parse_price_format($metas['compare_price']);
        }

        $metas['inventory_management'] = $metas['inventory_management'] ?? 0;
        $metas['disable_out_of_stock'] = $metas['disable_out_of_stock'] ?? 0;
        $metas['downloadable'] = $metas['downloadable'] ?? 0;

        if ($metas['quantity']) {
            $metas['quantity'] = (int) $metas['quantity'];
            $metas['quantity'] = max($metas['quantity'], 0);
        }

        $data['meta'] = $metas;
        return $data;
    }

    public function saveDataProduct($model, $data): void
    {
        if (Arr::has($data, 'meta')) {
            $variant = ProductVariant::findByProduct($model->id);
            $variantData = $data['meta'];
            $variantData['thumbnail'] = $data['thumbnail'];
            $variantData['description'] = seo_string(strip_tags($data['content']), 320);

            if ($variant) {
                $variant->update($variantData);
            } else {
                $variantData['title'] = 'Default';
                $variantData['names'] = ['Default'];
                $variantData['post_id'] = $model->id;

                $variant = ProductVariant::updateOrCreate(
                    ['id' => $variant->id ?? 0],
                    $variantData
                );
            }

            if ($downloadLinks = Arr::get($data, 'download_links')) {
                foreach ($downloadLinks as $link) {
                    $link['product_id'] = $model->id;
                    $ids[] = DownloadLink::updateOrCreate(
                        [
                            'id' => $link['id'],
                            'product_id' => $model->id,
                            'variant_id' => $variant->id,
                        ],
                        $link
                    )->id;
                }

                DownloadLink::whereNotIn('id', $ids)
                    ->where(['product_id' => $model->id, 'variant_id' => $variant->id])
                    ->delete();
            }
        }
    }

    
    public function addWithVariantsProductDetail(array $with): array
    {
        $with['variants'] = fn ($q) => $q->cacheFor(
            config('juzaweb.performance.query_cache.lifetime')
        );

        return $with;
    }

    public function addVariantsProductDetail(array $data, Post $resource): array
    {
        $data['variants'] = ProductVariantResource::collection($resource->variants)
            ->response()
            ->getData(true)['data'];
        return $data;
    }

}