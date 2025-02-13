<?php

namespace Mojahid\Ecommerce\Repositories;

use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;
use Mojahid\Ecommerce\Models\Cart;

class CartRepositoryEloquent extends BaseRepositoryEloquent implements CartRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Cart::class;
    }
}
