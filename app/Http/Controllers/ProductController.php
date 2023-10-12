<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ECode;
use App\Models\Exchange;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Transaction;
use App\Models\Rate;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $user = auth('sanctum')->user()->id;
        $this->validate($request, [
            'product_type_id'   =>'required',
            'country_id'       =>'required',
            // 'description'       =>'required',
            'amount'            =>'required',
            'collection_mode_id' => 'required',

        ]);

        $product = new Product();
        $product->user_id              =   $user;
        $product->country_id            =   $request->input('country_id');
        // $product->description          =   $request->input('description');
        $product->amount               =   $request->input('amount');
        $product->status_id            =   1;
        $product->product_type_id      =   $request->input('product_type_id');
        $product->collection_mode_id   =   $request->input('collection_mode_id');
        if ($product->product_type_id > 0) {
            if ($product->save()) {
                if ($product->collection_mode_id == 1) {
                        foreach ($request->product_images as $key => $value) {
                            $url = $value->store('public/gc');
                            $images_url = str_replace("public", "storage", $url);

                            $product_image = new ProductImage();
                            $product_image->product_id = $product->id;
                            $product_image->url = env("APP_URL")."/".$images_url;
                            $product_image->save();
                        }
                } else {
                    $this->validate($request, [
                        'e_code'   =>'required',
                        ]);
                        $ecode = new ECode();
                        $ecode->product_id = $product->id;
                        $ecode->e_code    = $request->input('e_code');
                        $ecode->save();
                }
            }else {
                return response()->json([
                    'Message' => 'Product not Saved'
                ]);
            }

        }else {
            return response()->json([
                'Message' => 'Select Product Type'
            ]);
        }
        if ($product->status_id == 1) {
            return response()->json([
                'Message' => 'Trade Sucessful',
                'Status'    => 'Pending',
                'data'      => $product
            ]);
        }else {
            return response()->json([
                'Message' => 'Trade Fail',
                'Status'  => 'Failed'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        $user = auth('sanctum')->user()->id;
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('user_id', $user)
        ->findorFail($id);
        return response()->json([
            'Message'   => 'Single Record',
            'Data'      => $product
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function SoftDeletes($id)
    {
        $product = Product::findorFail($id);
        if($product->delete()){

            return 'deleted successfully';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
