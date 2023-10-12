<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productType = ProductType::get();
        return response()->json([
            'Message' => 'All Products',
            'data'    => $productType,
        ]);
    }

    public function store(StoreProductTypeRequest $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'icon'=>'required|mimes:png,jpg,jpeg,gif|max:2048'
            ]);
            $image = $request->file('icon')->store('public/icon');
            $image_url = str_replace("public", "storage", $image);

            $productType = new ProductType();
            $productType->name      = $request->input('name');
            $productType->icon      =   env("APP_URL")."/".$image_url;
            $productType->save();
            return response()->json([
                'status' => 'Product Type Created Successfuly',
                'data'  => $productType
            ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType, $id)
    {
        $productType = ProductType::findorFail($id);
        return response()->json([
            'Message' => 'Product Details',
            'data'    => $productType
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTypeRequest  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTypeRequest $request, ProductType $productType, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'icon'=>'required|mimes:png,jpg,jpeg,gif|max:2048'
            ]);
            $image = $request->file('icon')->store('public/icon');
            $image_url = str_replace("public", "storage", $image);

            $productType = ProductType::findorFail($id);
            $productType->name      =   $request->input('name');
            $productType->icon      =   env("APP_URL")."/".$image_url;
            $productType->save();
            return response()->json([
                'status' => 'Product Type Created Successfuly',
                'data'  => $productType
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function SoftDeletes($id)
    {
        $productType = ProductType::findorFail($id);
        if($productType->delete()){

            return 'deleted successfully';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
