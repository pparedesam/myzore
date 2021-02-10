<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->delete();
        
        Provider::create(['personajuridica_id' => '2','nivel_id'=>'1']);

        $provider=Provider::create(['personajuridica_id' => '3','nivel_id'=>'2']);
      
       
        $userProvider = User::factory()->create([

            'name' => $provider->personajuridica->persona->nroDocumento,
            'email' => 'proveedor1@myzore.com',
            'password' => bcrypt('12345678'),
            'persona_id' => '2',
        ]);
        $userProvider->assignRole('Provider');

        
    }
}
