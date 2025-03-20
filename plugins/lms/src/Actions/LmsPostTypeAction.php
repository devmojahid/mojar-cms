<?php

namespace Mojahid\Lms\Actions;

use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Models\Taxonomy;
use Mojahid\Lms\Models\CourseTopic;

class LmsPostTypeAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );
        
        $this->addAction(
            'post_type.courses.form.left',
            [$this, 'addFormCourse']
        );

        $this->addFilter(
            'post_type.courses.parseDataForSave',
            [$this, 'parseDataForSave']
        );
        
        $this->addAction(
            "post_type.courses.after_save",
            [$this, 'saveDataCourse'],
            20,
            2
        );
    }

    /**
     * Register post types
    */
    public function registerPostTypes(): void
    {
        $courseInvisibleMetas = [
            'price',
            'compare_price',
            'max_students',
            'language',
            'difficulty_level',
            'preview_video_url',
        ];

        HookAction::registerPostType(
            'courses',
            [
                'label' => trans('lms::content.courses'),
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'category',
                    'tag'
                ],
                'metas' => collect($courseInvisibleMetas)
                    ->mapWithKeys(
                        fn ($item) => [$item => ['visible' => false]]
                    )
                    ->toArray(),
            ]
        );


    }

    public function addFormCourse($model): void
    {
        echo e(
            view(
                'lms::backend.lms.form',
                compact(
                    'model'
                )
            )
        );
    }

    public function parseDataForSave($data)
    {
        $metas = (array) $data['meta'];
        if ($metas['price']) {
            $metas['price'] = parse_price_format($metas['price']);
        }

        if ($metas['compare_price']) {
            $metas['compare_price'] = parse_price_format($metas['compare_price']);
        }

        // compare price should be greater than price
        if ($metas['compare_price'] && $metas['compare_price'] < $metas['price']) {
            $metas['compare_price'] = $metas['price'];
        }
 
        $metas['max_students'] = $metas['max_students'] ?? 0;
        $metas['language'] = $metas['language'] ?? '';
        $metas['preview_video_url'] = $metas['preview_video_url'] ?? '';

        if (!empty($metas['difficulty_level'])) {
            $validLevels = ['beginner', 'intermediate', 'advanced'];
            if (!in_array($metas['difficulty_level'], $validLevels)) {
                $metas['difficulty_level'] = 'beginner'; // Default
            }
        }

        $data['meta'] = $metas;
        return $data;
    }

     /**
     * Save additional course data after the main post is saved
     * 
     * @param \Juzaweb\Backend\Models\Post $model The saved post model
     * @param array $data The original form data
     */

    public function saveDataCourse($model, $data): void
    {
        // Make sure we have meta data
    }
}