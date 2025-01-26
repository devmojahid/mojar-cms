<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\DevTool\Commands\Resource;

use Juzaweb\DevTool\Abstracts\CRUD\ResourceCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * @deprecated
 */
class MojarResouceMakeCommand extends ResourceCommand
{
    /**
     * The name of argument being used.
     *
     * @var string
     */
    protected string $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:make-jwresource';

    public function handle()
    {
        $this->call(
            'plugin:make-crud',
            [
                'name' => $this->argument('name'),
                'module' => $this->getModuleName()
            ]
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the table.'],
            ['module', InputArgument::OPTIONAL, 'The name of plugin will be used.'],
        ];
    }
}
