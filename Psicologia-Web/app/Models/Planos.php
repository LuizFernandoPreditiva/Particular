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
        'valor',
        'user_id',
    ];

    public function pacientes(){
        return $this->hasMany(User::class, 'planos_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
