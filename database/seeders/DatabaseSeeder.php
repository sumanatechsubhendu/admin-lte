<?php

namespace Database\Seeders;

use Database\Seeders\RolesTableSeeder;
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
        // Call the RolesTableSeeder
        $this->call(RolesTableSeeder::class);
        $this->call(UserSeeder::class);
         \App\Models\User::factory(52)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Listing::factory(20)->create();
    }
}
