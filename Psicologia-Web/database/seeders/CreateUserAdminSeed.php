<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'admin',
                'email' => 'admin2@admin',
                'password' => Hash::make('123')
            ]
        ]);
    }
}
