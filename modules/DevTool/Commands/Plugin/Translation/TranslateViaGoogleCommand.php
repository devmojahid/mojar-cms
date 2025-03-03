<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\DevTool\Commands\Plugin\Translation;

use Illuminate\Console\Command;
use Juzaweb\CMS\Contracts\TranslationManager;
use Symfony\Component\Console\Input\InputArgument;

class TranslateViaGoogleCommand extends Command
{
    protected $name = 'plugin:google-translate';

    public function handle(): int
    {
        $translate = app(TranslationManager::class)->translate(
            $this->argument('source'),
            $this->argument('target'),
            'plugin',
            $this->argument('plugin')
        );

        $bar = $this->output->createProgressBar($translate->getTranslationLines()->count());
        $bar->start();

        $translate->progressCallback(
            function ($model) use ($bar) {
                $bar->advance();
            }
        );

        $result = $translate->run();

        $bar->finish();

        $this->newLine();
        $this->info("Translate success {$result} language text.");

        if ($errors = $translate->getErrors()) {
            $this->error(join("\n - ", $errors));
        }

        return self::SUCCESS;
    }

    protected function getArguments(): array
    {
        return [
            ['plugin', InputArgument::REQUIRED, 'The name of plugin will be import.'],
            ['source', InputArgument::REQUIRED, 'Source translate language.'],
            ['target', InputArgument::REQUIRED, 'Target translate language.'],
        ];
    }
}
