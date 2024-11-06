<?php

namespace Mojar\CMS\Support\Process;

use Mojar\CMS\Contracts\LocalPluginRepositoryContract;
use Mojar\CMS\Contracts\RunableInterface;

class Runner implements RunableInterface
{
    /**
     * The plugin instance.
     * @var LocalPluginRepositoryContract
     */
    protected $module;

    public function __construct(LocalPluginRepositoryContract $module)
    {
        $this->module = $module;
    }

    /**
     * Run the given command.
     *
     * @param string $command
     */
    public function run($command)
    {
        passthru($command);
    }
}
