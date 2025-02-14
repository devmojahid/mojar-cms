<?php

namespace Mojahid\Ecommerce\Extensions;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'App_Extension_Ecommerce_Custom';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ecom_get_cart_items', 'ecom_get_cart_items'),
            new TwigFunction('ecom_get_payment_methods', 'ecom_get_payment_methods'),
            new TwigFunction('ecom_get_cart', 'ecom_get_cart'),
        ];
    }
}
