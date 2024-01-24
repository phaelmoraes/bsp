<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $table = 'vendas';

    protected $fillable = [
        'id',
        'valor_total',
        'forma_pagamento',
        'lucro_estimado',
        'status',
        'parcelas',
        'cliente',
        'valor_pago',
        'user_id',
        'loja_id',
        'moto_id',
        'cpf'
    ];

    public function loja(){
        return $this->hasOne(Loja::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function moto(){
        return $this->belongsTo(Moto::class);
    }

    public function amount_paid($id){
        $venda = Venda::find($id);
        $amount_paid = Parcela::where('venda_id', $venda->id)->sum('amount_paid');

        return $amount_paid;
    }

    public function getParcelas(){
        return $this->hasMany(Parcela::class);
    }


}
