<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "url"
    ];
    /*
    |----------------------------------------------------------------------------------
    | Product Relationship To Product Image
    |----------------------------------------------------------------------------------
    */
    public function product(){
        return $this->belongsTo(Product::class);
    }
    protected $hidden = [
        'product_id',
        "deleted_at",
        "created_at",
        "updated_at",
        // 'id'
    ];
}
