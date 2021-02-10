<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProductImageType;

class ImageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productoimagestype')->delete();

        ProductImageType::create(['nombre' => 'Borrador']);
        ProductImageType::create(['nombre' => 'Publicacion']);
        
        
    }
}
