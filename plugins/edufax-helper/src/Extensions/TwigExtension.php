<?php

namespace Mojahid\EdufaxHelper\Extensions;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'EdufaxHelper_Extension';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('edufax_get_dashboard_stats', 'edufax_get_dashboard_stats'),
            new TwigFunction('edufax_get_recent_orders', 'edufax_get_recent_orders'),
            new TwigFunction('edufax_helper_filter_posts', 'edufax_helper_filter_posts'),
            new TwigFunction('edufax_helper_is_filtering', 'edufax_helper_is_filtering'),
        ];
    }
} 