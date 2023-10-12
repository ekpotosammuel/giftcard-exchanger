<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $appends = ['Transaction Type', 'user'];
    protected $hidden = [
        'deleted_at',
        // 'created_at',
        'updated_at',
        'transaction_type_id',
        'user_id',
        // 'id'
    ];


    /*
    |-----------------------------------------
    | GET TRANSACTION TYPE
    |-----------------------------------------
    */
    public function getTransactionTypeAttribute(){
        // body
        return TransactionType::where('id', $this->transaction_type_id)->first();
    }

    /*
    |-----------------------------------------
    | GET TRANSACTION TYPE
    |-----------------------------------------
    */
    public function getUserAttribute(){
        // body
        return User::where('id', $this->user_id)->first();
    }
}
