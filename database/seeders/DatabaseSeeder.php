<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Config;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Chimerasite',
            'email' => 'chimerasite22@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'is_admin' => true,
        ]);

        \App\Models\Config::create([
            'data' => 'upload forages',
            'value' => '1',
        ]);
        \App\Models\Config::create([
            'data' => 'upload comets',
            'value' => '1',
        ]);
        \App\Models\Config::create([
            'data' => 'create posts',
            'value' => '1',
        ]);
        \App\Models\Config::create([
            'data' => 'edit posts',
            'value' => '1',
        ]);
        \App\Models\Config::create([
            'data' => 'forage password',
            'value' => 'Xero!',
        ]);

        \App\Models\Role::create([
            'is_admin' => '0',
            'name' => 'user',
        ]);
        \App\Models\Role::create([
            'is_admin' => '1',
            'name' => 'admin',
        ]);
        \App\Models\Role::create([
            'is_admin' => '2',
            'name' => 'moderator',
        ]);
    }
}
