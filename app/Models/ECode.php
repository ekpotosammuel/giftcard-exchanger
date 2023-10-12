<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECode extends Model
{
    use HasFactory;
    protected $hidden = [
        'deleted_at',
        'updated_at',
        'product_id'
    ];
}
