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

use Faker\Generator as Faker;
use Mojar\Backend\Models\EmailList;
use Mojar\Backend\Models\EmailTemplate;
use Mojar\Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testIndex()
    {
        $this->get('admin-cp/register')->assertStatus(200);
    }

    public function testRegister()
    {
        set_config('user_verification', 0);

        $faker = app(Faker::class);

        $this->json(
            'POST',
            'admin-cp/register',
            [
                'name' => $faker->name,
                'email' => $faker->email,
                "password" => "123456@123",
                "password_confirmation" => "123456@123",
            ]
        )
            ->assertJson(['status' => true]);
    }

    public function testRegisterWithVerify()
    {
        set_config('user_verification', 1);

        $faker = app(Faker::class);

        $email = $faker->email;

        $this->json(
            'POST',
            'admin-cp/register',
            [
                'name' => $faker->name,
                'email' => $email,
                "password" => "123456@123",
                "password_confirmation" => "123456@123",
            ]
        )
            ->assertJson(['status' => true]);

        $this->assertDatabaseHas('users', ['email' => $email, 'status' => 'verification']);

        //$template = EmailTemplate::whereCode('verification')->first();

        $this->assertDatabaseHas(
            'email_lists',
            [
                'email' => $email,
                'template_code' => 'verification'
            ]
        );

        $token = EmailList::with(['template'])
            ->whereEmail($email)
            ->where('template_code', '=', 'verification')
            ->first();

        $this->get("admin-cp/verification/{$email}/{$token->params['verifyToken']}")
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $token->delete();
    }
}
