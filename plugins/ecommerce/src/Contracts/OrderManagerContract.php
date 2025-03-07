<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Contracts;

use Juzaweb\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Supports\OrderInterface;

/**
 * @see \Juzaweb\Ecommerce\Supports\Manager\OrderManager
 */
interface OrderManagerContract
{
    public function find(Order|string|int $order): null|OrderInterface;

    public function createByCart(CartContract $cart, array $data, User $user): OrderInterface;

    public function createByItems(array $data, array $items, User $user): OrderInterface;
}
