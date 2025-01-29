<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class PluginController extends BackendController
{       
    public function getPlugins()
    {
        return response()->json([
            'status' => true,
            'data' => [
                'plugins' => [],
            ],
        ]);

        // return response()->json(Theme::all());

    }
}
