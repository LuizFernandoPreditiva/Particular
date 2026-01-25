<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatePagamentosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $paciente1Id = DB::table('users')->where('email', 'paciente1@admin')->value('id');
        $paciente2Id = DB::table('users')->where('email', 'paciente2@admin')->value('id');

        if (!$paciente1Id || !$paciente2Id) {
            return;
        }

        DB::table('pagamentos')->insert([
            [
                'user_id' => $paciente1Id,
                'descricao' => 'Sessao inicial',
                'forma' => 'pix',
                'parcelas' => 1,
                'valor' => 200.00,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => $paciente2Id,
                'descricao' => 'Primeiro pacote',
                'forma' => 'dinheiro',
                'parcelas' => 2,
                'valor' => 150.00,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        $totais = DB::table('pagamentos')
            ->select('user_id', DB::raw('SUM(valor) as total'))
            ->groupBy('user_id')
            ->get();

        foreach ($totais as $total) {
            DB::table('users')
                ->where('id', $total->user_id)
                ->update([
                    'saldo' => $total->total,
                    'updated_at' => $now
                ]);
        }
    }
}
