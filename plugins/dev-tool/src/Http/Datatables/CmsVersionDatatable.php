<?php

namespace Mojarsoft\DevTool\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojarsoft\DevTool\Models\CmsVersion;

class CmsVersionDatatable extends DataTable
{
    /**
     * Get query source of dataTable.
     *
     * @param array $data
     * @return Builder
     */
    public function query($data): Builder
    {
        $query = CmsVersion::query()
            ->select([
                'id',
                'version',
                'description',
                'is_active',
                'created_at',
            ]);
            
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('version', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }
        
        return $query;
    }

    /**
     * Any additional data that you want to append to the datatable.
     *
     * @return array
     */
    public function getAppends(): array
    {
        return [];
    }

    /**
     * Get columns data source for dataTable.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'version' => [
                'label' => trans('Version'),
                'formatter' => function ($value, $row, $index) {
                    return $value;
                }
            ],
            'description' => [
                'label' => trans('Description'),
                'formatter' => function ($value, $row, $index) {
                    return $value ? substr($value, 0, 100) . (strlen($value) > 100 ? '...' : '') : '';
                }
            ],
            'is_active' => [
                'label' => trans('Active'),
                'width' => '10%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $value ? 
                        '<span class="badge bg-success">' . trans('Yes') . '</span>' : 
                        '<span class="badge bg-secondary">' . trans('No') . '</span>';
                }
            ],
            'created_at' => [
                'label' => trans('Created At'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($value);
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
                            'value' => "operations",
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
     * Get searchable columns data source for dataTable.
     *
     * @return array
     */
    public function searchFields(): array
    {
        return [
            'version' => [
                'type' => 'text',
                'label' => trans('Version'),
            ],
        ];
    }

    /**
     * Get filterable columns for dataTable.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Define bulk actions for dataTable.
     *
     * @return array
     */
    public function bulkActions($action, $ids)
    {
        $versions = CmsVersion::whereIn('id', $ids)->get();
        
        if ($action == 'delete') {
            foreach ($versions as $version) {
                // Delete file if exists
                if ($version->file_path) {
                    \Illuminate\Support\Facades\Storage::disk('local')->delete($version->file_path);
                }
                $version->delete();
            }
        }
    }
    
    /**
     * Get available bulk actions for dataTable.
     *
     * @return array
     */
    public function getBulkActions(): array
    {
        return [
            'delete' => [
                'label' => trans('Delete'),
                'action' => 'delete',
                'confirm' => trans('Are you sure you want to delete these versions?'),
            ],
        ];
    }

    /**
     * Get data table actions.
     *
     * @return array
     */
    public function actions(): array
    {
        return [
            'edit' => [
                'label' => trans('Edit'),
                'url' => function ($item) {
                    return route('admin.dev-tool.cms-versions.edit', [$item->id]);
                },
                'icon' => 'fa fa-edit',
            ],
            'delete' => [
                'label' => trans('Delete'),
                'class' => 'btn-danger',
                'action' => 'delete',
                'url' => function ($item) {
                    return route('admin.dev-tool.cms-versions.destroy', [$item->id]);
                },
                'confirm' => trans('Are you sure you want to delete this version?'),
                'icon' => 'fa fa-trash',
            ],
        ];
    }
} 