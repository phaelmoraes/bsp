<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $fillable = ['fabricante_id', 'modelo', 'ano', 'km', 'cilindrada','valor_compra', 'valor_vista', 'valor_credito', 'ex_proprietario', 'data_compra'];

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }

    public function fotos()
    {
        return $this->belongsToMany(Foto::class, 'moto_foto', 'moto_id', 'foto_id');
    }
}
