<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UbigeoSeeder::class);
        $this->call(DocumentoSeeder::class);
        $this->call(SexoSeeder::class);

        

        $this->call(PersonaJuricaSeeder::class);
        $this->call(PersonaNaturalSeeder::class);
        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(ProviderNivelSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(KardexSeeder::class);
        $this->call(CatalogTypeSeeder::class);

        $this->call(ImageTypeSeeder::class);
    }
}
