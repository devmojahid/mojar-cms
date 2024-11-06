<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/juzacms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojar\DevTool\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Mojar\CMS\Contracts\LocalPluginRepositoryContract;
use Mojar\CMS\Contracts\LocalThemeRepositoryContract;

class DevToolController extends Controller
{
    protected string $template = 'inertia';

    public function __construct(
        protected LocalPluginRepositoryContract $pluginRepository,
        protected LocalThemeRepositoryContract $themeRepository
    ) {
        //
    }

    public function index(): View|Response
    {
        $title = __('Dev Tool');

        return $this->view(
            'dev-tool/index',
            compact('title')
        );
    }

    public function getModules(): JsonResponse
    {
        $themes = $this->themeRepository->all(true)->values();
        $plugins = $this->pluginRepository->all(true)->values();

        return response()->json(compact('themes', 'plugins'));
    }

    public function getModule(Request $request): JsonResponse
    {
        //$module = $request->input('module');
        $type = $request->input('type');

        $configs = config("dev-tool.{$type}");

        $convertToArray = function (array $item, string $key) {
            $item['key'] = $key;
            return $item;
        };

        $configs['options'] = collect($configs['options'])
            ->map($convertToArray)
            ->values();

        return response()->json(
            [
                'configs' => $configs,
            ]
        );
    }
}
