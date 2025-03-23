<?php

namespace Mojarsoft\DevTool\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojarsoft\DevTool\Models\MarketplacePlugin;

class MarketplacePluginDatatable extends DataTable
{
    /**
     * Get query source of dataTable.
     *
     * @param array $data
     * @return Builder
     */
    public function query($data): Builder
    {
        $query = MarketplacePlugin::query()
            ->select([
                'id',
                'name',
                'title',
                'description',
                'thumbnail',
                'thumbnail_path',
                'is_paid',
                'price',
                'is_featured',
                'is_active',
                'created_at',
            ]);
            
        if (isset($data['is_active'])) {
            $query->where('is_active', $data['is_active']);
        }
        
        if (isset($data['is_featured'])) {
            $query->where('is_featured', $data['is_featured']);
        }
        
        if (isset($data['is_paid'])) {
            $query->where('is_paid', $data['is_paid']);
        }
        
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('title', 'LIKE', "%{$keyword}%")
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
            'thumbnail_path' => [
                'label' => trans('Thumbnail'),
                'width' => '80px',
                'formatter' => function ($value, $row, $index) {
                    return '<img src="' . upload_url($value) . '" class="img-thumbnail" style="max-width: 80px;">';
                }
            ],
            'title' => [
                'label' => trans('Title'),
                'formatter' => function ($value, $row, $index) {
                    return '<strong>' . $value . '</strong><br><small class="text-muted">' . $row->name . '</small>';
                }
            ],
            'description' => [
                'label' => trans('Description'),
                'formatter' => function ($value, $row, $index) {
                    return $value ? substr(strip_tags($value), 0, 100) . (strlen($value) > 100 ? '...' : '') : '';
                }
            ],
            'price' => [
                'label' => trans('Price'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    if ($row->is_paid) {
                        return '<span class="badge bg-info">' . ($value ?: 'Paid') . '</span>';
                    }
                    return '<span class="badge bg-success">Free</span>';
                }
            ],
            'is_featured' => [
                'label' => trans('Featured'),
                'width' => '8%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return $value ? 
                        '<span class="badge bg-primary">' . trans('Yes') . '</span>' : 
                        '<span class="badge bg-secondary">' . trans('No') . '</span>';
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
            ]
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
            'keyword' => [
                'type' => 'text',
                'label' => trans('Search'),
                'placeholder' => trans('Name, title, or description')
            ],
            'is_paid' => [
                'type' => 'select',
                'label' => trans('Type'),
                'options' => [
                    '' => trans('All'),
                    '1' => trans('Paid'),
                    '0' => trans('Free'),
                ],
            ],
            'is_featured' => [
                'type' => 'select',
                'label' => trans('Featured'),
                'options' => [
                    '' => trans('All'),
                    '1' => trans('Yes'),
                    '0' => trans('No'),
                ],
            ],
            'is_active' => [
                'type' => 'select',
                'label' => trans('Status'),
                'options' => [
                    '' => trans('All'),
                    '1' => trans('Active'),
                    '0' => trans('Inactive'),
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
            'is_paid' => [
                'type' => 'select',
                'label' => trans('Type'),
                'options' => [
                    '1' => trans('Paid'),
                    '0' => trans('Free'),
                ],
            ],
            'is_featured' => [
                'type' => 'select',
                'label' => trans('Featured'),
                'options' => [
                    '1' => trans('Yes'),
                    '0' => trans('No'),
                ],
            ],
            'is_active' => [
                'type' => 'select',
                'label' => trans('Status'),
                'options' => [
                    '1' => trans('Active'),
                    '0' => trans('Inactive'),
                ],
            ],
        ];
    }

    /**
     * Define bulk actions for dataTable.
     */
    public function bulkActions($action, $ids)
    {
        $plugins = MarketplacePlugin::whereIn('id', $ids)->get();
        
        switch ($action) {
            case 'delete':
                foreach ($plugins as $plugin) {
                    $plugin->delete();
                }
                break;
            case 'active':
                foreach ($plugins as $plugin) {
                    $plugin->update(['is_active' => true]);
                }
                break;
            case 'inactive':
                foreach ($plugins as $plugin) {
                    $plugin->update(['is_active' => false]);
                }
                break;
            case 'featured':
                foreach ($plugins as $plugin) {
                    $plugin->update(['is_featured' => true]);
                }
                break;
            case 'unfeatured':
                foreach ($plugins as $plugin) {
                    $plugin->update(['is_featured' => false]);
                }
                break;
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
            'active' => [
                'label' => trans('Set Active'),
                'action' => 'active',
                'confirm' => trans('Are you sure you want to activate these plugins?'),
            ],
            'inactive' => [
                'label' => trans('Set Inactive'),
                'action' => 'inactive',
                'confirm' => trans('Are you sure you want to deactivate these plugins?'),
            ],
            'featured' => [
                'label' => trans('Set Featured'),
                'action' => 'featured',
                'confirm' => trans('Are you sure you want to set these plugins as featured?'),
            ],
            'unfeatured' => [
                'label' => trans('Unset Featured'),
                'action' => 'unfeatured',
                'confirm' => trans('Are you sure you want to unset featured status for these plugins?'),
            ],
            'delete' => [
                'label' => trans('Delete'),
                'action' => 'delete',
                'confirm' => trans('Are you sure you want to delete these plugins?'),
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
                    return route('admin.dev-tool.marketplace-plugins.edit', [$item->id]);
                },
                'icon' => 'fa fa-edit',
            ],
            'delete' => [
                'label' => trans('Delete'),
                'class' => 'btn-danger',
                'action' => 'delete',
                'url' => function ($item) {
                    return route('admin.dev-tool.marketplace-plugins.destroy', [$item->id]);
                },
                'confirm' => trans('Are you sure you want to delete this plugin?'),
                'icon' => 'fa fa-trash',
            ],
        ];
    }
} 