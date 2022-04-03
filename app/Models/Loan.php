<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consumer;
use App\Models\LoanInstallment;

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

    public function amount_paid($id){
        $loan = Loan::find($id);
        $amount_paid = LoanInstallment::where('loan_id', $loan->id)->sum('amount_paid');

        return $amount_paid;
    }


}
