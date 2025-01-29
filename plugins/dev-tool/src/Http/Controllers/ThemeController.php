<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class ThemeController extends BackendController
{       
    public function getThemes()
    {
        return response()->json([
            'status' => true,
            'data' => [
                'themes' => [],
            ],
        ]);
        // return response()->json(Theme::all());

    }
}
