<?php

namespace Database\Seeders;

use App\Models\Sexo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexos')->delete();
        Sexo::create(['nombre' => 'HOMBRE']);
        Sexo::create(['nombre' => 'MUJER']);
    }
}
