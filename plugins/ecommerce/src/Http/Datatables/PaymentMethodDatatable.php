<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Models\PaymentMethod;

class PaymentMethodDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'name' => [
                'label' => trans('cms::app.name'),
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->{$row->getFieldName()},
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => false,
                            'actions_hidden' => true,
                        ]
                    )
                    ->render();
                }
            ],
            'active' => [
                'label' => trans('cms::app.status'),
                'width' => '10%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::components.datatable.active',
                        compact('row')
                    )->render();
                }
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '20%',
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
            ]
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
        $query = PaymentMethod::select(
            [
                'id',
                'name',
                'type',
                'active',
                'created_at'
            ]
        );

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('name', JW_SQL_LIKE, '%'. $keyword .'%');
            });
        }

        if ($type = Arr::get($data, 'type')) {
            $query->where('type', '=', $type);
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                PaymentMethod::destroy($ids);
                break;
        }
    }
}
