<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailHook
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public string $hook;
    public array $args = [];

    public function __construct($hook, $args = [])
    {
        $this->hook = $hook;
        $this->args = $args;
    }
}
