<?php

namespace Database\Seeders;

use App\Models\ProviderNivel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProviderNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provider_nivel')->delete();
        ProviderNivel::create(['nombre' => 'NIVEL 1']);
        ProviderNivel::create(['nombre' => 'NIVEL 2']);

        
    }
}
