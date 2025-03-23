<?php

namespace Mojarsoft\DevTool\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojarsoft\DevTool\Models\PackageVersion;

class PackageVersionDatatable extends DataTable
{
    /**
     * Get query source of dataTable.
     *
     * @param array $data
     * @return Builder
     */
    public function query($data): Builder
    {
        $query = PackageVersion::query()
            ->select([
                'id',
                'package_name',
                'package_type',
                'version',
                'description',
                'is_active',
                'created_at',
            ]);
            
        if (isset($data['package_type'])) {
            $query->where('package_type', $data['package_type']);
        }
        
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('package_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('version', 'LIKE', "%{$keyword}%")
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
            'package_name' => [
                'label' => trans('Package Name'),
                'formatter' => function ($value, $row, $index) {
                    return $value;
                }
            ],
            'package_type' => [
                'label' => trans('Type'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    $badgeClass = $value == 'plugin' ? 'bg-info' : 'bg-warning';
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($value) . '</span>';
                }
            ],
            'version' => [
                'label' => trans('Version'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    return $value;
                }
            ],
            'description' => [
                'label' => trans('Description'),
                'formatter' => function ($value, $row, $index) {
                    return $value ? substr($value, 0, 80) . (strlen($value) > 80 ? '...' : '') : '';
                }
            ],
            'is_active' => [
                'label' => trans('Active'),
                'width' => '8%',
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
            'package_name' => [
                'type' => 'text',
                'label' => trans('Package Name'),
            ],
            'version' => [
                'type' => 'text',
                'label' => trans('Version'),
            ],
            'package_type' => [
                'type' => 'select',
                'label' => trans('Type'),
                'options' => [
                    'plugin' => 'Plugin',
                    'theme' => 'Theme',
                ],
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
        return [
            'package_type' => [
                'type' => 'select',
                'label' => trans('Type'),
                'options' => [
                    'plugin' => 'Plugin',
                    'theme' => 'Theme',
                ],
            ],
        ];
    }

    /**
     * Define bulk actions for dataTable.
     *
     * @return array
     */
    public function bulkActions($action, $ids)
    {
        $versions = PackageVersion::whereIn('id', $ids)->get();
        
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
                    return route('admin.dev-tool.package-versions.edit', [$item->id]);
                },
                'icon' => 'fa fa-edit',
            ],
            'delete' => [
                'label' => trans('Delete'),
                'class' => 'btn-danger',
                'action' => 'delete',
                'url' => function ($item) {
                    return route('admin.dev-tool.package-versions.destroy', [$item->id]);
                },
                'confirm' => trans('Are you sure you want to delete this version?'),
                'icon' => 'fa fa-trash',
            ],
        ];
    }
} 