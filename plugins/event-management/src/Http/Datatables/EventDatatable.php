<?php

namespace Mojahid\EventManagement\Http\Datatables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojahid\EventManagement\Models\EventBooking;


class EventDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'code' => [
                'label' => trans('evman::content.code'),
                'width' => '15%',
            ],

            'name' => [
                'label' => trans('evman::content.name'),
                'formatter' => function ($value, $row, $index) {
                    return view('cms::backend.items.datatable_item', [
                        'value' => $row->name,
                        'row' => $row,
                        'actions' => $this->rowAction($row),
                        'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                        'title_hidden' => false,
                        'actions_hidden' => true,
                    ])
                    ->render();
                },
                'width' => '20%',
            ],

            'phone' => [
                'label' => trans('evman::content.phone'),
            ],
            'email' => [
                'label' => trans('evman::content.email'),
            ],
            'total' => [
                'label' => trans('evman::content.total'),
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ],
            'operations' => [
                'label' => trans('cms::app.operations'),
                'width' => '10%',
                'align' => 'center',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->{$row->getFieldName()},
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => true,
                            'actions_hidden' => false,
                        ]
                    )
                    ->render();
                },
            ],
        ];
    }

    /**
     * Query data datatable
     *
     * @param  array  $data
     * @return Builder
     */
    public function query(array $data): \Illuminate\Contracts\Database\Query\Builder
    {
        $query = EventBooking::select(
            [
                'id',
                'code',
                'name',
                'email',
                'phone',

                'total',
                'created_at',
            ]
        );

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (Builder $q) use ($keyword) {
                    $q->where('name', JW_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('email', JW_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('phone', JW_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                EventBooking::destroy($ids);
                break;
        }

    }
}
