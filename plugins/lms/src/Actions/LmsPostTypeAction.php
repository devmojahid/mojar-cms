<?php

namespace Mojahid\Lms\Actions;

use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Models\Taxonomy;
use Mojahid\Lms\Models\CourseTopic;

class LmsPostTypeAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );
        
        $this->addAction(
            'post_type.courses.form.left',
            [$this, 'addFormCourse']
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

        
        // Add shop page filter
        $this->addFilter(
            'theme.get_view_page',
            [$this, 'addShopPage'],
            20,
            2
        );

        $this->addFilter(
            'theme.get_params_page',
            [$this, 'addShopParams'],
            20,
            2
        );
    }

    /**
     * Register post types
    */
    public function registerPostTypes(): void
    {
        $productInvisibleMetas = [
            'price',
            'downloadable',
        ];

        HookAction::registerPostType(
            'courses',
            [
                'label' => trans('lms::content.courses'),
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


    }

    public function addFormCourse($model): void
    {
        $topic = CourseTopic::findByTopic($model->id);
        if ($topic === null) {
            $topic = new CourseTopic();
        }

        echo e(
            view(
                'lms::backend.lms.form',
                compact(
                    'topic',
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

    
    // Add new method for shop page view
    public function addShopPage($view, $page): string
    {
        $shopPage = get_config('_shop_page');

        if ($shopPage == $page->id) {
            return 'lms::frontend.shop.index';
        }

        return $view;
    }

    // Add new method for shop page parameters
    public function addShopParams($params, $page)
    {
        $shopPage = get_config('_shop_page');

        if ($shopPage == $page->id) {
            return array_merge($params, [
                'products' => $this->getShopProducts(),
                'categories' => $this->getProductCategories(),
                'filters' => $this->getProductFilters(),
                'sort_options' => $this->getSortOptions()
            ]);
        }

        return $params;
    }

    protected function getShopProducts()
    {
        $query = Post::wherePostType('products')
            ->wherePublish()
            ->with(['taxonomies', 'metas']);

        // Apply filters from request
        if ($category = request('category')) {
            $query->whereTaxonomy('categories', $category);
        }

        if ($search = request('search')) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        // Apply sorting
        $sort = request('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderByMeta('price', 'asc');
                break;
            case 'price_high':
                $query->orderByMeta('price', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        return $query->paginate(12);
    }

    protected function getProductCategories()
    {
        return Taxonomy::where('taxonomy', 'categories')
            ->where('post_type', 'products')
            ->whereHas('posts', function($q) {
                $q->wherePublish();
            })
            ->get();
    }

    protected function getProductFilters()
    {
        return [
            'price_range' => [
                'min' => Post::wherePostType('products')->min('price') ?? 0,
                'max' => Post::wherePostType('products')->max('price') ?? 1000
            ],
            // Add more filters as needed
        ];
    }

    protected function getSortOptions()
    {
        return [
            'latest' => trans('lms::content.latest'),
            'price_low' => trans('lms::content.price_low_to_high'),
            'price_high' => trans('lms::content.price_high_to_low'),
            'popularity' => trans('lms::content.most_popular')
        ];
    }

}