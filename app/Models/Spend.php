<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    use HasFactory;
    protected $table = 'spend';

    public function collaborator($id){
        $collaborator = User::find($id);
        return $collaborator;
    }

    public function region($id){
        $region = Region::find($id);
        return $region;
    }
}

