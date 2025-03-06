<?php

namespace Juzaweb\Backend\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use Juzaweb\CMS\Support\RequirementsChecker;
use Juzaweb\CMS\Support\PermissionsChecker;

class RequirementsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker, PermissionsChecker $permissions)
    {
        $this->requirements = $checker;
        $this->permissions = $permissions;
    }

    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */
    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );

        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        $permissions = $this->permissions->check([
            'storage/' => '775',
            'bootstrap/cache/' => '775',
            'resources/' => '775',
            'public/' => '775',
            'plugins/' => '775',
            'themes/' => '775',
            'vendor/' => '775',
        ]);

        return view('cms::installer.requirements', compact('requirements', 'phpSupportInfo', 'permissions'));
    }
}