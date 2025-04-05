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
            
            // Get SQL file content
            $sql = File::get($path);
            
            // Split SQL by semicolons to get individual queries
            // This is a simple split that works for most cases, but complex SQL may need more robust handling
            $queries = array_filter(array_map('trim', explode(';', $sql)), 'strlen');
            
            DB::beginTransaction();
            
            foreach ($queries as $query) {
                if (!empty($query)) {
                    DB::unprepared($query);
                }
            }
            
            DB::commit();
            
            $message = "SQL file imported successfully";
            $outputLog->write($message, 1);
            
            return [
                'status' => 'success',
                'message' => $message,
                'dbOutputLog' => $outputLog->fetch(),
            ];
        } catch (Exception $e) {
            DB::rollBack();
            
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