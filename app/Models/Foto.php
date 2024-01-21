<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['caminho', 'moto_id'];

    public function moto()
    {
        return $this->belongsTo(Moto::class, 'moto_id');
    }
}
