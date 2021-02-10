<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Genero;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\Linea;
use App\Models\Material;
use App\Models\Talla;
use App\Models\Tipo;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('generos')->delete();
        Genero::create(['nombre' => 'DAMAS' ]);
        Genero::create(['nombre' => 'CABALLEROS']);
        Genero::create(['nombre' => 'NIÑOS' ]);
        Genero::create(['nombre' => 'BEBES' ]);

        DB::table('tallas')->delete();
        Talla::create(['nombre' => '32']);
        Talla::create(['nombre' => '34']);
        Talla::create(['nombre' => '36']);
        Talla::create(['nombre' => '38']);
        Talla::create(['nombre' => 'S']);
        Talla::create(['nombre' => 'M']);
        Talla::create(['nombre' => 'L']);


        DB::table('colors')->delete();
        Color::create(['nombre' => 'AMARILLO','hexadecimal'=>'F7E22A']);
        Color::create(['nombre' => 'ANIMAL PRINT','hexadecimal'=>'F7E22A']);
        Color::create(['nombre' => 'AZUL','hexadecimal'=>'0D2436']);
        Color::create(['nombre' => 'BEIGE','hexadecimal'=>'F4C062']);
        Color::create(['nombre' => 'BLANCO','hexadecimal'=>'FFFFFF']);
        Color::create(['nombre' => 'CAMEL','hexadecimal'=>'DC8B1E']);
        Color::create(['nombre' => 'CELESTE','hexadecimal'=>'BDE1E0']);
        Color::create(['nombre' => 'COBALTO','hexadecimal'=>'24583E']);
        Color::create(['nombre' => 'COBRE','hexadecimal'=>'AB551B']);
        Color::create(['nombre' => 'CORAL','hexadecimal'=>'E62C0F']);
        Color::create(['nombre' => 'HUESO','hexadecimal'=>'FAFAD6']);
        Color::create(['nombre' => 'HUMO','hexadecimal'=>'FAFAD6']);
        Color::create(['nombre' => 'LUCUMA','hexadecimal'=>'EAA92F']);
        Color::create(['nombre' => 'MAIZ','hexadecimal'=>'F4DE62']);
        Color::create(['nombre' => 'MARRÓN','hexadecimal'=>'2E0C0C']);
        Color::create(['nombre' => 'MELANGE','hexadecimal'=>'E0DFDA']);
        Color::create(['nombre' => 'MELÓN','hexadecimal'=>'F5D8B9']);
        Color::create(['nombre' => 'MIEL','hexadecimal'=>'E9BC68']);
        Color::create(['nombre' => 'MOSTAZA','hexadecimal'=>'E3AC19']);
        Color::create(['nombre' => 'NEGRO','hexadecimal'=>'000000']);
        Color::create(['nombre' => 'NUDE','hexadecimal'=>'FAEEE6']);
        Color::create(['nombre' => 'PALO ROSA','hexadecimal'=>'FEB6CD']);
        Color::create(['nombre' => 'PLOMO','hexadecimal'=>'959591']);
        Color::create(['nombre' => 'ROJO','hexadecimal'=>'F70B27']);
        Color::create(['nombre' => 'ROSA','hexadecimal'=>'FBD7F6']);
        Color::create(['nombre' => 'VERDE','hexadecimal'=>'256610']);
        Color::create(['nombre' => 'VINO','hexadecimal'=>'76081C']);


        DB::table('materials')->delete();
        DB::table('tipos')->delete();
        DB::table('lineas')->delete();
        Linea::create(['nombre' => 'ACCESORIOS', 'slug' => 'accesorios']);
        Linea::create(['nombre' => 'CALZADO', 'slug' => 'calzado']);
        Linea::create(['nombre' => 'ROPA','slug' => 'ropa']);

        
        Tipo::create(['nombre' => 'BALLERINAS','linea_id'=>'2']);
        Tipo::create(['nombre' => 'BOTAS','linea_id'=>'2']);
        Tipo::create(['nombre' => 'BOTINES','linea_id'=>'2']);
        Tipo::create(['nombre' => 'DERBY','linea_id'=>'2']);
        Tipo::create(['nombre' => 'LOAFER','linea_id'=>'2']);
        Tipo::create(['nombre' => 'MOCASINES','linea_id'=>'2']);
        Tipo::create(['nombre' => 'SANDALIAS','linea_id'=>'2']);
        Tipo::create(['nombre' => 'STILLETOS','linea_id'=>'2']);
        Tipo::create(['nombre' => 'ZAPATILLAS','linea_id'=>'2']);

        Tipo::create(['nombre' => 'BEBECRECER','linea_id'=>'3']);
        Tipo::create(['nombre' => 'BIVIDI','linea_id'=>'3']);
        Tipo::create(['nombre' => 'BLAZER','linea_id'=>'3']);
        Tipo::create(['nombre' => 'BLUSA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'BUZO','linea_id'=>'3']);
        Tipo::create(['nombre' => 'CAMISA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'CAPA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'CASACA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'CHOMPA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'ENTERIZO','linea_id'=>'3']);
        Tipo::create(['nombre' => 'FALDA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'JEANS','linea_id'=>'3']);
        Tipo::create(['nombre' => 'JEGGINS','linea_id'=>'3']);
        Tipo::create(['nombre' => 'LEGGINS','linea_id'=>'3']);
        Tipo::create(['nombre' => 'PANTALÓN','linea_id'=>'3']);
        Tipo::create(['nombre' => 'POLERA','linea_id'=>'3']);
        Tipo::create(['nombre' => 'POLO','linea_id'=>'3']);
        Tipo::create(['nombre' => 'PONCHO','linea_id'=>'3']);
        Tipo::create(['nombre' => 'SACO','linea_id'=>'3']);
        Tipo::create(['nombre' => 'SHORT','linea_id'=>'3']);
        Tipo::create(['nombre' => 'VESTIDO','linea_id'=>'3']);

        
        Material::create(['nombre' => 'CUERO','linea_id' => '2' ]);
        Material::create(['nombre' => 'PU','linea_id' => '2' ]);
        Material::create(['nombre' => 'TEXTIL','linea_id' => '2' ]);

        Material::create(['nombre' => 'ANGORA','linea_id' => '3' ]);
        Material::create(['nombre' => 'CATANIA','linea_id' => '3' ]);
        Material::create(['nombre' => 'CHALIS','linea_id' => '3' ]);
        Material::create(['nombre' => 'DENIM','linea_id' => '3' ]);
        Material::create(['nombre' => 'DRIL','linea_id' => '3' ]);
        Material::create(['nombre' => 'ENCAJE','linea_id' => '3' ]);
        Material::create(['nombre' => 'FRANELA','linea_id' => '3' ]);
        Material::create(['nombre' => 'FRENCH TERRY','linea_id' => '3' ]);
        Material::create(['nombre' => 'FULL LICRA','linea_id' => '3' ]);
        Material::create(['nombre' => 'GASA','linea_id' => '3' ]);
        Material::create(['nombre' => 'HILO','linea_id' => '3' ]);
        Material::create(['nombre' => 'JERSEY','linea_id' => '3' ]);
        Material::create(['nombre' => 'LANILLA','linea_id' => '3' ]);
        Material::create(['nombre' => 'LINO','linea_id' => '3' ]);
        Material::create(['nombre' => 'NANSU','linea_id' => '3' ]);
        Material::create(['nombre' => 'PAÑO','linea_id' => '3' ]);
        Material::create(['nombre' => 'PIEL DE DURAZNO','linea_id' => '3' ]);
        Material::create(['nombre' => 'PONTIROMA','linea_id' => '3' ]);
        Material::create(['nombre' => 'RIB','linea_id' => '3' ]);
        Material::create(['nombre' => 'SEDA','linea_id' => '3' ]);
        Material::create(['nombre' => 'SUEDE','linea_id' => '3' ]);
        Material::create(['nombre' => 'TERCIOPELO','linea_id' => '3' ]);
        Material::create(['nombre' => 'TUL','linea_id' => '3' ]);
        Material::create(['nombre' => 'VISCOSA','linea_id' => '3' ]);
    }
}
