<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;
    protected $table = 'venda_parcelas';

    protected $fillable = [
        'id',
        'valor',
        'n_parcela',
        'status',
        'valor_pago',
        'venda_id',
        'user_id'
    ];
}
