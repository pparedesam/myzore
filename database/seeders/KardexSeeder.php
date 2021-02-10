<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KardexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kardexTipoDetalle')->delete();
        DB::insert('insert into kardexTipoDetalle (tipo) values (?)', ['INGRESO']);
        DB::insert('insert into kardexTipoDetalle (tipo) values (?)', ['EGRESO']);

        
    }
}
