<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Insert 'admin' role
        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web', // Assuming you're using the 'web' guard
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert 'user' role
        DB::table('roles')->insert([
            'name' => 'user',
            'guard_name' => 'web', // Assuming you're using the 'web' guard
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
