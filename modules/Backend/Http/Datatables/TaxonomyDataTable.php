<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Backend\Http\Datatables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Juzaweb\CMS\Abstracts\DataTable;
use Juzaweb\Backend\Models\Taxonomy;

class TaxonomyDataTable extends DataTable
{
    protected $taxonomy;

    public function mount($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function columns(): array
    {
        $columns = [
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
                },
            ]
        ];

        if (in_array('hierarchical', Arr::get($this->taxonomy, 'supports', []))) {
            $columns['parent'] = [
                'label' => trans('cms::app.parent'),
                'width' => '20%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $row->parent->name ?? '__';
                }
            ];
        }

        $columns['total_post'] = [
            'label' => trans('cms::app.total_posts'),
            'width' => '15%',
            'align' => 'center',
        ];

        $columns['created_at'] = [
            'label' => trans('cms::app.created_at'),
            'width' => '15%',
            'align' => 'center',
            'formatter' => function ($value, $row, $index) {
                return jw_date_format($row->created_at);
            },
        ];

        $columns['operations'] = [
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
        ];

        return $columns;
    }

    /**
     * Query data datatable
     *
     * @param array $data
     * @return Builder
     */
    public function query($data)
    {
        /**
         * @var Builder $query
         */
        $query = $this->makeModel()->query()->with('parent');
        $data['taxonomy'] = $this->taxonomy['taxonomy'];

        if ($this->taxonomy['taxonomy'] != 'tags') {
            $data['post_type'] = $this->taxonomy['post_type'];
        }

        $query->whereFilter($data);

        return $query;
    }

    public function rowAction($row): array
    {
        $data = parent::rowAction($row);

        $data['view'] = [
            'label' => trans('cms::app.view'),
            'url' => $row->getLink(),
            'target' => '_blank',
        ];

        return $data;
    }

    public function bulkActions($action, $ids): void
    {
        foreach ($ids as $id) {
            DB::beginTransaction();
            try {
                switch ($action) {
                    case 'delete':
                        $model = $this->makeModel()->find($id);
                        $model->delete($id);
                        break;
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }

    protected function makeModel()
    {
        return app(Taxonomy::class);
    }
}
