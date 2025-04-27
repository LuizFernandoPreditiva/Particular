<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\ClientesFactory;

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
        \App\Models\Clientes::factory(20)->create();

        $this->call([
            CreateUserAdminSeed::class,
            CreateClientesSeed::class
        ]);
        
    }
}
