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
            new TwigFunction('lms_get_reviews', 'lms_get_reviews'),
            new TwigFunction('lms_get_average_rating', 'lms_get_average_rating'),
            new TwigFunction('lms_get_review_stats', 'lms_get_review_stats'),
            new TwigFunction('lms_get_lesson_count', 'lms_get_lesson_count'),
            new TwigFunction('lms_get_student_count', 'lms_get_student_count'),
        ];
    }
}
