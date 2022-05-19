<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Loan;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'function',
    ];

    public function region(){
        return $this->hasOne('App\Models\Region');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function loanToday($id){
        $day = date("Y-m-d");
        $value = Loan::whereDate('created_at', $day)->where('status', '!=','cancelled')->where('user_id', $id)->sum('price');
        // dd($day, $value);
        return $value;
    }

    public function loanInstallmentsToday($id){
        $day = date("Y-m-d");
        $value = LoanInstallment::whereDate('updated_at', $day)->where('user_id', $id)->sum('amount_paid');
        // dd($day, $value);
        return $value;
    }
}
