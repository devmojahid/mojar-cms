<?php

namespace Mojar\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Mojar\Backend\Models\Taxonomy;

class TaxonomyTableSeeder extends Seeder
{
    public function run()
    {
        Taxonomy::factory(20)->create();
    }
}
