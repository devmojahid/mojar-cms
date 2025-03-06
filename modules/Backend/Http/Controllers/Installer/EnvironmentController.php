<?php

namespace Juzaweb\Backend\Http\Controllers\Installer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Events\EnvironmentSaved;
use Juzaweb\CMS\Support\Manager\EnvironmentManager;

class EnvironmentController extends Controller
{
    protected EnvironmentManager $environmentManager;

    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->environmentManager = $environmentManager;
    }

    public function environment(): \Illuminate\Contracts\View\View
    {
        $envConfig = $this->environmentManager->getEnvContent();

        return view('cms::installer.environment', compact('envConfig'));
    }

    public function save(Request $request, Redirector $redirect): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'database_connection' => 'required|in:mysql,sqlite,pgsql,sqlsrv',
            'database_hostname' => 'required|string|max:150',
            'database_port' => 'required|numeric',
            'database_name' => 'required|string|max:150',
            'database_username' => 'required|string|max:150',
            'database_password' => 'nullable|string|max:150',
            'database_prefix' => 'nullable|string|max:10',
            'app_name' => 'nullable|string|max:150',
            'app_url' => 'nullable|string|max:150',
            'mail_driver' => 'nullable|string|max:150',
            'smtp_host' => 'nullable|string|max:150',
            'smtp_port' => 'nullable|numeric',
            'smtp_username' => 'nullable|string|max:150',
            'smtp_password' => 'nullable|string|max:150',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $redirect->route('installer.environment')
                ->withInput()
                ->withErrors($validator->errors());
        }

        // save smtp config
        $this->saveSmtpConfig($request);

        // save app config
        $this->saveAppConfig($request);

        if (! $this->checkDatabaseConnection($request)) {
            return $redirect->route('installer.environment')
                ->withInput()
                ->withErrors([
                    'database_connection' => trans('cms::installer.environment.wizard.form.db_connection_failed'),
                ]);
        }

        $results = $this->environmentManager->saveFileWizard($request);

        event(new EnvironmentSaved($request));

        return $redirect->route('installer.database')
            ->with(['results' => $results]);
    }

    private function checkDatabaseConnection(Request $request)
    {
        $connection = $request->input('database_connection');

        $settings = config("database.connections.{$connection}");

        config([
            'database' => [
                'default' => $connection,
                'connections' => [
                    $connection => array_merge($settings, [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password'),
                    ]),
                ],
            ],
        ]);

        DB::purge();

        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function saveSmtpConfig(Request $request)
    {
        $smtpConfig = [
            'mail_driver' => $request->input('mail_driver'),
            'smtp_host' => $request->input('smtp_host'),
            'smtp_port' => $request->input('smtp_port'),
            'smtp_username' => $request->input('smtp_username'),
            'smtp_password' => $request->input('smtp_password'),
        ];

        config(['mail' => $smtpConfig]);
    }
    
    private function saveAppConfig(Request $request)
    {
        $appConfig = [
            'app_name' => $request->input('app_name'),
            'app_url' => $request->input('app_url'),
        ];

        config(['app' => $appConfig]);
    }
}
