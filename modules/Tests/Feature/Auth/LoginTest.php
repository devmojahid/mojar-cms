<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Tests\Feature\Auth;

use Illuminate\Support\Facades\Hash;
use Juzaweb\CMS\Models\User;
use Juzaweb\Tests\TestCase;

class LoginTest extends TestCase
{
    public function testIndex()
    {
        $this->get('app/login')->assertStatus(200);
    }

    public function testLogin()
    {
        $user = User::factory()->create(['password' => Hash::make('12345678')]);

        $this->json(
            'POST',
            '/app/login',
            [
                'email' => $user->email,
                'password' => '12345678',
            ]
        )
            ->assertJson(['status' => true]);
    }
}
