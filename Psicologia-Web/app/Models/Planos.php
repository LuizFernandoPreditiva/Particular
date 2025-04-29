<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'valor'
    ];

    public function clientes(){
        return $this->hasMany(Clientes::class, 'plano_id');
    }


}
