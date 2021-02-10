<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\PersonaJuridica;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaJuricaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->delete();
        DB::table('personasjuridicas')->delete();
        Persona::create([
            'telefono' => '777888777',
            'documento_id' => '2',
            'nroDocumento' => '20111111111',
            'direccion' => 'DIRECCION TRUJILLO',
            'region_id' => '13',
            'provincia_id' =>'1301',
            'distrito_id' =>'130101'
            ]);
        PersonaJuridica::create(['razonSocial' => 'My Zore','persona_id' => '1']);

        Persona::create([
            'telefono' => '963703874',
            'documento_id' => '2',
            'nroDocumento' => '10426539310',
            'email' => 'INFOVISIONARIAPERU@GMAIL.COM',
            'direccion' => 'mia.milagros.costti@gmail.com',
            'region_id' => '15',
            'provincia_id' =>'1501',
            'distrito_id' =>'150110'
            ]);
        PersonaJuridica::create(['razonSocial' => 'MONICA KARINA MONTES ','personaContacto'=>'MONICA MONTES','persona_id' => '2']);

        Persona::create([
            'telefono' => '946428179',
            'documento_id' => '2',
            'nroDocumento' => '99999999999',
            'direccion' => 'CALLE MIGUEL GRAU 192 URB. VALDIVIESO',
            'email' => 'mia.milagros.costti@gmail.com',
            'region_id' => '15',
            'provincia_id' =>'1501',
            'distrito_id' =>'150103'
            ]);
            PersonaJuridica::create(['razonSocial' => 'MIA','personaContacto'=>'MILAGROS COSTTI','persona_id' => '2']);

    }
}
