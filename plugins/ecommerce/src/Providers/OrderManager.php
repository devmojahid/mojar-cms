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

use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Support\Payment;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Supports\Creaters\OrderCreater;
use Mojahid\Ecommerce\Supports\OrderInterface;

class OrderManager implements OrderManagerContract
{
    protected OrderCreater $orderCreater;

    protected Payment $payment;

    public function __construct(
        OrderCreater $orderCreater,
        Payment $payment
    ) {
        $this->orderCreater = $orderCreater;
        $this->payment = $payment;
    }

    public function find(Order|string|int $order): null|OrderInterface
    {
        if ($order instanceof Order) {
            return $this->createOrder($order);
        }

        $model = Order::findByCode($order);

        return $model ? $this->createOrder($model) : null;
    }

    public function createByCart(
        CartContract $cart,
        array $data,
        User $user
    ): OrderInterface {
        return $this->createByItems(
            $data,
            $cart->getItems(),
            $user
        );
    }

    public function createByItems(array $data, array $items, User $user): OrderInterface
    {
        $order = $this->orderCreater->create($data, $items, $user);

        return $this->createOrder($order);
    }

    protected function createOrder(Order $order): OrderInterface
    {
        return new Order(
            $order,
            $this->payment
        );
    }
}
