<?php

namespace Juzaweb\CMS\Repositories\Generators\Commands;

use Illuminate\Console\Command;
use Juzaweb\CMS\Repositories\Generators\CriteriaGenerator;
use Juzaweb\CMS\Repositories\Generators\FileAlreadyExistsException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CriteriaCommand
 *
 * @package Prettus\Repository\Generators\Commands
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class CriteriaCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:criteria';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new criteria.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Criteria';

    /**
     * Execute the command.
     *
     * @return void
     * @see fire()
     */
    public function handle()
    {
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            (new CriteriaGenerator(
                [
                    'name' => $this->argument('name'),
                    'force' => $this->option('force'),
                ]
            ))->run();

            $this->info("Criteria created successfully.");
        } catch (FileAlreadyExistsException $ex) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of class being generated.',
                null,
            ],
        ];
    }

    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null,
            ],
        ];
    }
}
