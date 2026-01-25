<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'descricao',
        'forma',
        'parcelas',
        'valor'
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
