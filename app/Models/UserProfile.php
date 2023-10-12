<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class UserProfile extends Model
{
    use HasFactory;
    protected $appends = ['currency', 'user', 'country', 'balance'];
    protected $fillable = [
        'user_id',
        'country_id',
        'currency_id'
    ];
    protected $hidden =[
        // 'user_id',
        'country_id',
        'currency_id'
    ];
    /*
    |-----------------------------------------
    | GET CURRENCY
    |-----------------------------------------
    */
    public function getCurrencyAttribute(){
        // body
        return Currency::where('id', $this->currency_id)->first();
    }
    /*
    |-----------------------------------------
    | GET COUNTRY
    |-----------------------------------------
    */
    public function getCountryAttribute(){
        // body
        return Country::where('id', $this->country_id)->first();
    }
    /*
    |-----------------------------------------
    | GET USER
    |-----------------------------------------
    */
    public function getUserAttribute(){
        // body
        return User::where('id', $this->user_id)->first();
    }
    /*
    |-----------------------------------------
    | GET BALANCE
    |-----------------------------------------
    */
    public function getBalanceAttribute(){
        // body
        $total_debit = Transaction::where([['user_id', $this->user_id], ['transaction_type_id', 1]])->sum('amount');
        $total_credit = Transaction::where([['user_id', $this->user_id], ['transaction_type_id', 2]])->sum('amount');
        return $total_credit - $total_debit;
    }
}
