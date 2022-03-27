<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consumer;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'price',
        'total_price',
        'fees',
        'priod',
        'status',
        'installments',
        'balance',
        'consumer_id',
        'user_id',
    ];

    public function consumer(){
        return $this->belongsTo('App\Models\Consumer');
    }

    public function region(){
        return $this->belongsTo('App\Models\Region');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


}
