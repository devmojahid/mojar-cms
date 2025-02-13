<?php

namespace Mojahid\Ecommerce\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Models\Product;
use Mojahid\Ecommerce\Models\ProductVariant;

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
    }

    /**
     * Register post types
    */
    public function registerPostTypes(): void
    {
        $productInvisibleMetas = [
            'price',
            'images',
            'social_links',
            'venue',
            'venue_address',
            'latitude',
            'longitude',
            'map_url',
            'map_embed_code',
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

}