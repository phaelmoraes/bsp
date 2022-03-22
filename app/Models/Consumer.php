<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Contact;
use app\Models\Address;

class Consumer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'enum',
        'cnpj',
        'cpf',
        'name',
        'birthday',
        'gender',
        'email',
        'note',
        'password',
    ];

    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }

    public function address(){
        return $this->hasOne('App\Models\Address');
    }

    public function loan(){
        return $this->hasOne('App\Models\Loan');
    }


}
