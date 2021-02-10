<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('documentos')->delete();
        Documento::create(['nombre' => 'DNI']);
        Documento::create(['nombre' => 'RUC']);
    }
}
