<?php

namespace Mojahid\EventManagement\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;

class EventManagementAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );

        // $this->addAction(
        //     Action::INIT_ACTION,
        //     [$this, 'registerConfigs']
        // );
        
        $this->addAction(
            'post_type.events.form.left',
            [$this, 'addFormEvent']
        );

    }


    /**
     * Register post types
     */
    public function registerPostTypes(): void
    {
        $eventInvisibleMetas = [
            'price',
            'sku_code',
            'barcode',
            'quantity',
            'inventory_management',
            'disable_out_of_stock',
            'downloadable',
        ];

        HookAction::registerPostType(
            'events',
            [
                'label' => trans('evman::content.events'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M15 19l2 2l4 -4" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'category',
                    'tag'
                ],
                'metas' => collect($eventInvisibleMetas)
                    ->mapWithKeys(
                        fn ($item) => [$item => ['visible' => false]]
                    )

                    ->toArray(),
            ]
        );

        HookAction::registerTaxonomy(
            'event_spicker',
            'events',
            [
                'label' => trans('evman::content.event_spicker'),
                'menu_position' => 11,
                'supports' => [
                    'thumbnail'
                ],
                'metas' => [
                    'poster' => [
                        'label' => trans('evman::app.poster'),
                        'type' => 'image',
                        'sidebar' => false,
                    ],
                ]
            ]
        );

    }

    public function addFormEvent($model): void
    {
        echo e(
            view(
                'evman::backend.event.form',
                [   
                    'model' => $model
                ]
            )
        );

    }

    
}