<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductImage;
use App\Models\CollectionMode;
use App\Models\ECode;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |----------------------------------------------------------------------------------
    | Filliable For Mass Assignment
    |----------------------------------------------------------------------------------
    */
    // protected $appends = ['eCode'];
    protected $appends = ['Country'];

    protected $fillable = [
        "description",
        "product_type_id",
        "user_id",
        'country_id',
        'collection_mode_id',
        'amount'

    ];

    protected $hidden = [
        'product_type_id',
        'user_id',
        'country_id',
        'collection_mode_id',
        'deleted_at',
        'updated_at',
    ];

    /*
    |----------------------------------------------------------------------------------
    | Product Images
    |----------------------------------------------------------------------------------
    */
    public function productImages(){
        return $this->hasMany(ProductImage::class); // added images
    }
    /*
    |----------------------------------------------------------------------------------
    | Product Type Relationship
    |----------------------------------------------------------------------------------
    */
    public function productType(){
        return $this->belongsTo(ProductType::class);
    }

    /*
    |----------------------------------------------------------------------------------
    | User Relationship
    |----------------------------------------------------------------------------------
    */
    public function user(){
        return $this->belongsTo(User::class);
    }


    /*
    |----------------------------------------------------------------------------------
    | User Collection
    |----------------------------------------------------------------------------------
    */
    public function collectionMode(){
        return $this->belongsTo(CollectionMode::class);
    }


    /*
    |----------------------------------------------------------------------------------
    | Ecode
    |----------------------------------------------------------------------------------
    */
    public function eCode(){
        return $this->hasMany(ECode::class);
    }
    // public function getProductImageAttribute(){
    //     // body
    //     return $this->hasMany(ProductImage::class);
    // }

    // public function geteCodeAttribute(){
    //     return ECode::where('id', $this->product_id)->first();
    // }

        /*
    |----------------------------------------------------------------------------------
    | Status
    |----------------------------------------------------------------------------------
    */
    public function status(){
        return $this->belongsTo(Status::class);
    }


    /*
    |----------------------------------------------------------------------------------
    | Country
    |----------------------------------------------------------------------------------
    */
    public function country(){
        return $this->belongsTo(Country::class);
    }

            /*
    |-----------------------------------------
    | GET STAMP BALANCE
    |-----------------------------------------
    */
    public function getCountryAttribute(){
        // body
        return Country::where('id', $this->country_id)->first();

    }


}
