<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotoFoto extends Model
{
    protected $table = 'moto_foto';

    protected $fillable = ['moto_id', 'foto_id'];

    // Relação muitos para muitos com a tabela "fotos"
    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }

    // Relação muitos para muitos com a tabela "motos"
    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }
}
