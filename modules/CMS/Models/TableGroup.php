<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Models;

/**
 * Mojar\CMS\Models\TableGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $table
 * @property int $total_rows
 * @property array $migrations
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup whereMigrations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableGroup whereTotalRows($value)
 */
class TableGroup extends Model
{
    protected $table = 'table_groups';

    protected $fillable = [
        'table',
        'total_rows',
        'migrations'
    ];

    public $timestamps = false;

    public $casts = [
        'migrations' => 'array'
    ];
}
