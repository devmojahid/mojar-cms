<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports\Manager;   

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Models\Cart;

class CartManager implements CartManagerContract
{
    public function __construct()
    {
        //
    }

    public function find(string|Cart $cart = null): CartContract
    {
        if (empty($cart)) {
            $cart = $this->getCodeCurrentCart();

            return $this->createCart($cart);
        }

        return $this->createCart($cart);
    }

    public function getCodeCurrentCart(): string
    {
        $cart = Cookie::get('jw_cart');

        if (empty($cart)) {
            return Str::uuid()->toString();
        }

        return $cart;
    }

    protected function createCart(string|Cart $cart): CartContract
    {
        return app(CartContract::class)->make($cart);
    }
}
