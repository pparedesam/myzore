<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name'=>'Super-Admin']);
        $roleProvider = Role::create(['name'=>'Provider']);
        $roleSocio = Role::create(['name'=>'Socio']);

        Permission::create(['name'=>'admin.home'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'productos.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'productos.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'productos.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'productos.destroy'])->syncRoles([$roleAdmin]);

        Permission::create(['name'=>'admin.catalogs.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'admin.catalogs.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'admin.catalogs.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'admin.catalogs.destroy'])->syncRoles([$roleAdmin]);

        Permission::create(['name'=>'admin.socios.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'admin.socios.create'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'admin.socios.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name'=>'admin.socios.destroy'])->syncRoles([$roleAdmin]);

        Permission::create(['name'=>'socio.orders.index'])->syncRoles([$roleAdmin,$roleSocio]);
        Permission::create(['name'=>'socio.orders.create'])->syncRoles([$roleAdmin,$roleSocio]);
        Permission::create(['name'=>'socio.orders.edit'])->syncRoles([$roleAdmin,$roleSocio]);
        Permission::create(['name'=>'socio.orders.destroy'])->syncRoles([$roleAdmin,$roleSocio]);

    }
}
