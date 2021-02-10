<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@myzore.com',
            'password' => bcrypt('12345678'),
            'persona_id' => '1',
        ])->assignRole('Super-Admin');
    }
}
