<?php

namespace Database\Seeders;

use App\Models\CatalogType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalog_types')->delete();
        CatalogType::create(['nombre' => 'ESTANDAR']);
        CatalogType::create(['nombre' => 'LIQUIDACIÓN']);
    }
}
