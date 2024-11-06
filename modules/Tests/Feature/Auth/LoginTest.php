<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Tests\Feature\Auth;

use Illuminate\Support\Facades\Hash;
use Mojar\CMS\Models\User;
use Mojar\Tests\TestCase;

class LoginTest extends TestCase
{
    public function testIndex()
    {
        $this->get('admin-cp/login')->assertStatus(200);
    }

    public function testLogin()
    {
        $user = User::factory()->create(['password' => Hash::make('12345678')]);

        $this->json(
            'POST',
            '/admin-cp/login',
            [
                'email' => $user->email,
                'password' => '12345678',
            ]
        )
            ->assertJson(['status' => true]);
    }
}
