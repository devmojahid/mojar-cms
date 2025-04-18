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

use Mojahid\Ecommerce\Models\Cart;

interface CartManagerContract
{
    public function find(string|Cart $cart = null): CartContract;

    public function getCodeCurrentCart(): string;
}
