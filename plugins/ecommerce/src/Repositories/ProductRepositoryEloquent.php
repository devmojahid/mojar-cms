<?php

namespace Mojahid\Ecommerce\Repositories;

use Juzaweb\Backend\Repositories\PostRepositoryEloquent;
use Mojahid\Ecommerce\Models\Product;

/**
 * Class TaxonomyRepositoryEloquentEloquent.
 *
 * @package namespace Mojahid\Ecommerce\Repositories;
 */
class ProductRepositoryEloquent extends PostRepositoryEloquent implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }
}
