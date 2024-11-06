<?php

namespace Mojar\Backend\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use Mojar\CMS\Events\InstallerFinished;
use Mojar\CMS\Support\Manager\FinalInstallManager;
use Mojar\CMS\Support\Manager\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param FinalInstallManager $finalInstall
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function finish(
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall
    ) {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();

        event(new InstallerFinished());

        return view('cms::installer.finished', compact(
            'finalMessages',
            'finalStatusMessage'
        ));
    }
}
