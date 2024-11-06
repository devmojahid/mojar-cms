<?php

namespace Mojar\CMS\Models;

/**
 * Mojar\CMS\Models\ResourceModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceModel whereFilter($params = [])
 * @mixin \Eloquent
 */
class ResourceModel extends Model
{
    use \Mojar\CMS\Traits\ResourceModel;
}
