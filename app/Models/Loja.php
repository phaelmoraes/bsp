<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $table = 'loja';

    protected $fillable = ['loja'];

    public function vendedor(){
        return $this->belongsTo('App\Models\User');
    }
}
