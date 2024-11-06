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

use Mojar\CMS\Database\Seeders\DatabaseSeeder;
use Mojar\Tests\TestCase;

class DatabaseTest extends TestCase
{
    public function testMigration(): void
    {
        $this->artisan('migrate:refresh')
            ->assertExitCode(0);
    }

    public function testSeed(): void
    {
        $this->artisan(
            'db:seed',
            [
                '--class' => DatabaseSeeder::class
            ]
        )
            ->assertExitCode(0);
    }

    public function testMakeAdmin(): void
    {
        $this->artisan('cms:make-admin')
            ->expectsQuestion('Full Name?', 'Taylor Otwell')
            ->expectsQuestion('Email?', 'admin@admin.com')
            ->expectsQuestion('Password?', 'admin@admin.com')
            ->assertExitCode(0);
    }

    public function testMakeEmailTemplate(): void
    {
        $this->artisan('mail:generate-template')
            ->assertExitCode(0);
    }
}
