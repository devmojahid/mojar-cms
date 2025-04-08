<?php
namespace Juzaweb\CMS\Support\Database;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\BufferedOutput;

final class ImportDatabaseService
{
    /**
     * Import an SQL file into the database.
     *
     * @param string $path The path to the SQL file.
     * @param BufferedOutput|null $outputLog Optional output log.
     * @return array Result status and message.
     */
    public function import(string $path, ?BufferedOutput $outputLog = null): array
    {
        if ($outputLog === null) {
            $outputLog = new BufferedOutput();
        }

        if (!File::exists($path)) {
            $message = "SQL file not found at path: {$path}";
            $outputLog->write($message, 1);
            return [
                'status' => 'error',
                'message' => $message,
                'dbOutputLog' => $outputLog->fetch(),
            ];
        }

        try {
            $outputLog->write("Importing SQL file: {$path}", 1);
            
            // Purge connections and reset
            DB::purge(DB::getDefaultConnection());
            DB::connection()->setDatabaseName(DB::getDatabaseName());
            
            // Drop all existing tables for a clean import
            $outputLog->write("Dropping all existing tables", 1);
            DB::getSchemaBuilder()->dropAllTables();
            
            // Import the SQL file directly without splitting
            $outputLog->write("Beginning SQL file import", 1);
            DB::unprepared(File::get($path));
            
            $message = "SQL file imported successfully";
            $outputLog->write($message, 1);
            
            return [
                'status' => 'success',
                'message' => $message,
                'dbOutputLog' => $outputLog->fetch(),
            ];
        } catch (Exception $e) {
            $message = "Error importing SQL file: " . $e->getMessage();
            $outputLog->write($message, 1);
            
            return [
                'status' => 'error',
                'message' => $message,
                'dbOutputLog' => $outputLog->fetch(),
            ];
        }
    }
}