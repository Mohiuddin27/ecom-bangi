<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([

            // UserSeeder::class,
            // // RoleSeeder::class,
            // PermissionSeeder::class,
            SettingSeeder::class,
        ]);
    }

     
}
