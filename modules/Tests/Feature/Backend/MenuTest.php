<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Tests\Feature\Backend;

use Faker\Generator as Faker;
use Juzaweb\Backend\Models\Menu;
use Juzaweb\Tests\TestCase;

class MenuTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->authUserAdmin();
    }

    public function testMakeMenu()
    {
        $faker = app(Faker::class);
        $data = ['name' => $faker->sentence(5)];

        $response = $this->post("/app/menus/store", $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('menus', $data);

        $data = ['name' => ''];
        $response = $this->post("/app/menus/store", $data);
        $response->assertStatus(302);

        $response->assertSessionHasErrors('name');
    }

    public function testEdit()
    {
        $menu = Menu::first();

        $this->get("/app/menus/{$menu->id}")
            ->assertStatus(200);
    }
}
