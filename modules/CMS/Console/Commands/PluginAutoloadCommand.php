<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PluginAutoloadCommand extends Command
{
    protected $signature = 'juzacms:plugin-autoload';

    public function handle(): int
    {
        $fileList = glob(config('mojar.plugin.path') . '/*/composer.json');
        $vendorDir = base_path('plugins');

        $psr4 = [];
        $files = [];
        foreach ($fileList as $filename) {
            if (!is_file($filename)) {
                continue;
            }

            $content = json_decode(file_get_contents($filename), true);
            $folder = basename(dirname($filename));

            if (!empty($content['autoload']) && is_array($content['autoload'])) {
                foreach ($content['autoload']['psr-4'] ?? [] as $namespace => $path) {
                    $path = rtrim($path, '/');
                    $psr4[$namespace] = array("__VENDOR_DIR__{$folder}/{$path}");
                }

                foreach ($content['autoload']['files'] ?? [] as $path) {
                    $path = rtrim($path, '/');
                    if (!file_exists("{$vendorDir}/{$folder}/{$path}")) {
                        throw new \Exception("No such file or directory in {$vendorDir}/{$folder}/{$path}");
                    }

                    $files[strtolower(Str::random(32))] = "__VENDOR_DIR__{$folder}/{$path}";
                }
            }
        }

        $this->putArrayFileContents('plugin_autoload_psr4.php', $psr4);
        $this->putArrayFileContents('plugin_autoload_files.php', $files);

        $this->info('Generating optimized autoload plugin files');

        return self::SUCCESS;
    }

    protected function putArrayFileContents($filename, $array)
    {
        $psr4Content = $this->varExportShort($array);
        $psr4Content = str_replace('\'__VENDOR_DIR__', '$vendorDir . \'/', $psr4Content);

        $fileContent = "<?php \n\n";
        $fileContent .= "\$vendorDir = dirname(dirname(dirname(__FILE__))) . '/plugins';\n
    \$baseDir = dirname(dirname(dirname(__FILE__)));\n\n";
        
        // Add this to load plugin vendor autoloads
        if ($filename === 'plugin_autoload_files.php') {
            $fileContent .= "// Load plugin vendor autoloads\n";
            $fileContent .= "\$pluginFolders = glob(\$vendorDir . '/*', GLOB_ONLYDIR);\n";
            $fileContent .= "foreach (\$pluginFolders as \$pluginFolder) {\n";
            $fileContent .= "    \$vendorAutoload = \$pluginFolder . '/vendor/autoload.php';\n";
            $fileContent .= "    if (file_exists(\$vendorAutoload)) {\n";
            $fileContent .= "        require_once \$vendorAutoload;\n";
            $fileContent .= "    }\n";
            $fileContent .= "}\n\n";
        }
        
        $fileContent .= "return {$psr4Content};";
        $fileContent .= "\n";
        file_put_contents(base_path('bootstrap/cache/' . $filename), $fileContent);
    }

    protected function putArrayFileContentsOld($filename, $array)
    {
        $psr4Content = $this->varExportShort($array);
        $psr4Content = str_replace('\'__VENDOR_DIR__', '$vendorDir . \'/', $psr4Content);

        $fileContent = "<?php \n\n";
        $fileContent .= "\$vendorDir = dirname(dirname(dirname(__FILE__))) . '/plugins';\n
\$baseDir = dirname(dirname(dirname(__FILE__)));\n\n";
        $fileContent .= "return {$psr4Content};";
        $fileContent .= "\n";
        file_put_contents(base_path('bootstrap/cache/' . $filename), $fileContent);
    }

    protected function varExportShort($var): ?string
    {
        $output = json_decode(
            str_replace(
                ['(', ')'],
                ['&#40', '&#41'],
                json_encode($var)
            ),
            true
        );

        return var_export($output, true);
    }
}
