<?php

namespace Juzaweb\CMS\Support\Manager;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Juzaweb\CMS\Facades\Config as DbConfig;
use Juzaweb\CMS\Support\Database\ImportDatabaseService;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseManager
{
    /**
     * @var ImportDatabaseService
     */
    private ImportDatabaseService $importDatabaseService;

    /**
     * @var string
     */
    private string $sqlFilePath;

    /**
     * DatabaseManager constructor.
     *
     * @param ImportDatabaseService $importDatabaseService
     */
    public function __construct(ImportDatabaseService $importDatabaseService)
    {
        $this->importDatabaseService = $importDatabaseService;
        $this->sqlFilePath = base_path('database.sql');
    }

    /**
     * Import SQL file and setup initial configs.
     *
     * @return array
     * @throws Exception
     * @throws \Throwable
     */
    public function run(): array
    {
        $outputLog = new BufferedOutput();
        $this->sqlite($outputLog);

        $importResult = $this->importDatabase($outputLog);
        if ($importResult['status'] == 'error') {
            return $this->response($importResult['message'], 'error', $outputLog);
        }

        DB::beginTransaction();
        try {
            $this->makeConfig();
            $this->makeEmailTemplate($outputLog);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return $this->response($e->getMessage(), 'error', $outputLog);
        }

        return $importResult;
    }

    /**
     * Import database from SQL file.
     *
     * @param BufferedOutput $outputLog
     * @return array
     */
    private function importDatabase(BufferedOutput $outputLog): array
    {
        return $this->importDatabaseService->import($this->sqlFilePath, $outputLog);
    }

    /**
     * Return a formatted error messages.
     *
     * @param string $message
     * @param string $status
     * @param BufferedOutput $outputLog
     * @return array
     */
    private function response($message, $status, BufferedOutput $outputLog): array
    {
        return [
            'status' => $status,
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }

    /**
     * Check database type. If SQLite, then create the database file.
     *
     * @param BufferedOutput $outputLog
     */
    private function sqlite(BufferedOutput $outputLog): void
    {
        if (DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if (! file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
            $outputLog->write('Using SqlLite database: ' . $database, 1);
        }
    }

    /**
     * Set SQL file path to use for database import.
     *
     * @param string $path
     * @return self
     */
    public function setSqlFilePath(string $path): self
    {
        $this->sqlFilePath = $path;
        return $this;
    }

    /**
     * Get the current SQL file path.
     *
     * @return string
     */
    public function getSqlFilePath(): string
    {
        return $this->sqlFilePath;
    }

    private function makeConfig(): void
    {
        DbConfig::setConfig('title', 'Mojar - Laravel CMS for Your Project');
        DbConfig::setConfig(
            'description',
            'Mojar is a Content Management System (CMS)'
                . ' and web platform whose sole purpose is to make your development workflow simple again.'
        );
        DbConfig::setConfig('author_name', 'Mojar Team');
        DbConfig::setConfig('user_registration', 1);
        DbConfig::setConfig('user_verification', 0);
    }

    private function makeEmailTemplate(BufferedOutput $outputLog): array
    {
        try {
            Artisan::call('mail:generate-template', [], $outputLog);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 'error', $outputLog);
        }

        return $this->response(trans('cms::installer.final.database_finished'), 'success', $outputLog);
    }
}
