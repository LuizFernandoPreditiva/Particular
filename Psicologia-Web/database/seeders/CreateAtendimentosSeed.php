<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateAtendimentosSeed extends Seeder
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

        DB::table('atendimentos')->insert([
            [
                'user_id' => $paciente1Id,
                'agendamento' => Carbon::now()->subDays(7)->setTime(9, 0),
                'atendido' => Carbon::now()->subDays(7)->setTime(9, 0),
                'duracao' => 50,
                'falta' => 0,
                'trabalho' => 'Avaliacao inicial',
                'resumo' => 'Primeira sessao realizada',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => $paciente1Id,
                'agendamento' => Carbon::now()->subDays(3)->setTime(9, 0),
                'atendido' => null,
                'duracao' => 50,
                'falta' => 1,
                'trabalho' => null,
                'resumo' => 'Cliente faltou',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => $paciente2Id,
                'agendamento' => Carbon::now()->subDays(5)->setTime(14, 0),
                'atendido' => Carbon::now()->subDays(5)->setTime(14, 0),
                'duracao' => 50,
                'falta' => 0,
                'trabalho' => 'Atendimento em grupo',
                'resumo' => 'Sessao concluida',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => $paciente2Id,
                'agendamento' => Carbon::now()->addDays(2)->setTime(14, 0),
                'atendido' => null,
                'duracao' => 50,
                'falta' => 0,
                'trabalho' => null,
                'resumo' => null,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        $resumo = DB::table('atendimentos')
            ->select(
                'user_id',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(falta) as faltas'),
                DB::raw('SUM(CASE WHEN atendido IS NOT NULL THEN 1 ELSE 0 END) as atendidos')
            )
            ->groupBy('user_id')
            ->get();

        foreach ($resumo as $linha) {
            DB::table('users')
                ->where('id', $linha->user_id)
                ->update([
                    'atendimentos' => $linha->total,
                    'faltas' => $linha->faltas,
                    'updated_at' => $now
                ]);

            $cliente = DB::table('users')
                ->where('id', $linha->user_id)
                ->first(['id', 'planos_id', 'saldo']);

            if ($cliente && $linha->atendidos > 0) {
                $valorPlano = DB::table('planos')
                    ->where('id', $cliente->planos_id)
                    ->value('valor');

                $valorPlano = $valorPlano ? $valorPlano : 0;

                DB::table('users')
                    ->where('id', $cliente->id)
                    ->update([
                        'saldo' => $cliente->saldo - ($linha->atendidos * $valorPlano),
                        'updated_at' => $now
                    ]);
            }
        }
    }
}
