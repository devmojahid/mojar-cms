<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Events;

use Mojahid\Ecommerce\Models\Order;

class PaymentSuccess
{
    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
