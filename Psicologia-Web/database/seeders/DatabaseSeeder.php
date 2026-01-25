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
        

        $this->call([
            CreateRulesSeed::class,
            CreateUserAdminSeed::class,
            CreatePlanosSeed::class,
            CreatePacientesSeed::class,
            CreatePagamentosSeed::class,
            CreateAtendimentosSeed::class
        ]);

        //\App\Models\Clientes::factory(20)->create();
        
    }
}
