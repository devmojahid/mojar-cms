<?php

namespace Juzaweb\CMS\Console\Commands\Permission;

use Illuminate\Console\Command;
use Juzaweb\CMS\Contracts\Permission as PermissionContract;

class CreatePermission extends Command
{
    protected $signature = 'permission:create-permission
                {name : The name of the permission}
                {guard? : The name of the guard}';

    protected $description = 'Create a permission';

    public function handle()
    {
        $permissionClass = app(PermissionContract::class);

        $permission = $permissionClass::findOrCreate($this->argument('name'), $this->argument('guard'));

        $this->info("Permission `{$permission->name}` " . ($permission->wasRecentlyCreated ? 'created' : 'already exists'));
    }
}