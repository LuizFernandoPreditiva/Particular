<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRulesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            [
                'id' => 1,
                'descricao' => 'administrador',
            ],
            [
                'id' => 2,
                'descricao' => 'psicologo',
            ],
            [
                'id' => 3,
                'descricao' => 'atendente',
            ],
            [
                'id' => 4,
                'descricao' => 'paciente',
            ],
        ]);
    }
}
