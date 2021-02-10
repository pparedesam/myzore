<?php

namespace Database\Seeders;

use App\Models\Distrito;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Region;
use App\Models\Provincia;


class UbigeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();
        $jsonRegion = File::get("database/data/regiones.json");
        $dataRegion = json_decode($jsonRegion);
        foreach ($dataRegion as $obj) {
            Region::create(array(
                'id' => $obj->id,
                'nombre' => $obj->nombre,
            ));
        }

        DB::table('provincias')->delete();
        $jsonProvincia = File::get("database/data/provincias.json");
        $dataProvincia = json_decode($jsonProvincia);
        foreach ($dataProvincia as $obj) {
            Provincia::create(array(
                'id' => $obj->id,
                'nombre' => $obj->nombre,
                'region_id' => $obj->region_id,
            ));
        }

        DB::table('distritos')->delete();
        $jsonDistrito = File::get("database/data/distritos.json");
        $dataDistrito = json_decode($jsonDistrito);
        foreach ($dataDistrito as $obj) {
            Distrito::create(array(
                'id' => $obj->id,
                'nombre' => $obj->nombre,
                'region_id' => $obj->region_id,
                'provincia_id' => $obj->provincia_id,
            ));
        }
    }
}
