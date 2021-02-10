<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaNaturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('personasnaturales')->delete();
        Persona::create([
            'telefono' => '12345678',
            'documento_id' => '1',
            'nroDocumento' => '12345678',
            'direccion' => 'DIRECCION TRUJILLO',
            'region_id' => '13',
            'provincia_id' => '1301',
            'distrito_id' => '130101'
            ]);
        
        Persona::create([
            'telefono' => '444555666',
            'documento_id' => '1',
            'nroDocumento' => '11223344',
            'direccion' => 'DIRECCION LIMA',
            'region_id' => '15',
            'provincia_id' =>'1501',
            'distrito_id' =>'150101'
            ]);
        
 
    }
}
