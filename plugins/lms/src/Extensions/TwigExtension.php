<?php

namespace Mojahid\Lms\Extensions;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'App_Extension_Lms_Custom';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('lms_get_cart_items', 'lms_get_cart_items'),
            new TwigFunction('lms_get_payment_methods', 'lms_get_payment_methods'),
            new TwigFunction('lms_get_cart', 'lms_get_cart'),
            new TwigFunction('lms_price_with_unit', 'lms_price_with_unit'),
            new TwigFunction('lms_price_with_currency', 'lms_price_with_currency'),
        ];
    }
}
