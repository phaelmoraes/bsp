<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $fillable = ['fabricante'];

    public function motos()
    {
        return $this->hasMany(Moto::class);
    }
}
