<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Tests\Unit;

use Mojar\Tests\TestCase;

class OptimizeTest extends TestCase
{
    public function testOptimize()
    {
        $this->artisan('optimize')
            ->assertExitCode(0);
    }

    public function testOptimizeClear()
    {
        $this->artisan('optimize:clear')
            ->assertExitCode(0);
    }
}
