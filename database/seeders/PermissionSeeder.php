<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'Super-Admin']);
        $superAdmin = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@myzore.com',
            'password' => bcrypt('12345678'),
            'persona_id' => '1',
        ]);
        $superAdmin->assignRole($superAdminRole);

        /* $providerRole = Role::create(['name' => 'Provider']);
        $provider = User::factory()->create([
            'name' => 'proveedor',
            'email' => 'proveedor@myzore.com',
            'password' => bcrypt('12345678'),
            'persona_id' => '1',
        ]);
        $provider->assignRole($providerRole);

        $socioRole = Role::create(['name' => 'Socio']);
        $socio = User::factory()->create([
            'name' => 'client',
            'email' => 'client@myzore.com',
            'password' => bcrypt('password'),
        ]);
        $socio->assignRole($socioRole); */
        
        Permission::create(['name'=>'gestionar productos']);

        Permission::create(['name'=>'listar productos']);
        Permission::create(['name'=>'crear productos']);
        Permission::create(['name'=>'editar productos']);
        Permission::create(['name'=>'eliminar productos']);

        Permission::create(['name'=>'listar mis productos']);


        Permission::create(['name'=>'gestionar usuarios']);

        Permission::create(['name'=>'listar usuarios']);
        Permission::create(['name'=>'crear usuarios']);
        Permission::create(['name'=>'editar usuarios']);
        Permission::create(['name'=>'eliminar usuarios']);

        Permission::create(['name'=>'gestionar socios']);

        Permission::create(['name'=>'listar socios']);
        Permission::create(['name'=>'crear socios']);
        Permission::create(['name'=>'editar socios']);
        Permission::create(['name'=>'eliminar socios']);

        Permission::create(['name'=>'listar mis socios']);
        Permission::create(['name'=>'editar mis socios']);
        Permission::create(['name'=>'eliminar mis socios']);
        

        Permission::create(['name'=>'gestionar almacenes']);

        Permission::create(['name'=>'listar almacenes']);
        Permission::create(['name'=>'crear almacenes']);
        Permission::create(['name'=>'editar almacenes']);
        Permission::create(['name'=>'eliminar almacenes']);

        Permission::create(['name'=>'gestionar kardex']);

        Permission::create(['name'=>'listar kardex']);
        Permission::create(['name'=>'crear kardex']);
        Permission::create(['name'=>'editar kardex']);
        Permission::create(['name'=>'eliminar kardex']);
        
        Permission::create(['name'=>'listar mis kardex']);
        Permission::create(['name'=>'crear mis kardex']);
        Permission::create(['name'=>'editar mis kardex']);
        Permission::create(['name'=>'eliminar mis kardex']);


        Permission::create(['name'=>'gestionar pedidos']);

        Permission::create(['name'=>'listar  pedidos']);
        Permission::create(['name'=>'crear pedidos']);
        Permission::create(['name'=>'editar pedidos']);
        Permission::create(['name'=>'eliminar pedidos']);

        Permission::create(['name'=>'listar mis pedidos']);
        Permission::create(['name'=>'editar mis pedidos']);
        Permission::create(['name'=>'eliminar mis pedidos']);
        
        $providerRole = Role::create(['name' => 'Provider']);
        $providerRole->givePermissionTo('gestionar kardex');

        $superAdmin->givePermissionTo([
            'listar productos', 
            'crear productos',
            'editar productos',
            'eliminar productos',
            'listar usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'listar socios',
            'gestionar usuarios'
        ]);


        /* $provider->givePermissionTo([
            
           
        ]);

        $socio->givePermissionTo([
            'gestionar pedidos',
            'listar mis pedidos',
            'editar mis pedidos',
            'eliminar pedidos',

            'gestionar socios',
            'listar mis socios',
            'editar mis socios',
            'eliminar mis socios',
            'crear socios',
            
        ]); */

    }
    
}
