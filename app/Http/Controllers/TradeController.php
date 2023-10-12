<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Transaction;
use Illuminate\Support\Str;

class TradeController extends Controller
{
    public function all()
    {
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->get();
        return response()->json([
            'Message' => 'All Trade',
            'data'    => $product
        ]);
    }


    public function pending()
    {
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('status_id', 1)
        ->get();
        return response()->json([
            'Message' => 'All Pending Trade',
            'data'    => $product
        ]);
    }

    public function successful()
    {
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('status_id', 3)
        ->get();
        return response()->json([
            'Message' => 'All successful Trade',
            'data'    => $product
        ]);
    }

    public function decline()
    {
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('status_id', 2)
        ->get();
        return response()->json([
            'Message' => 'All decline Trade',
            'data'    => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])->findorFail($id);
        return response()->json([
            'Message' => 'Single Trade Record',
            'dtat'    => $product
        ]);
    }

    public function sell(Request $request, Product $product, $id)
    {
            $this->validate($request, [
                'status_id' => 'required',
            ]);

            $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])->findorFail($id);
            $product->status_id = $request->input('status_id');
            $product->country_id  = $product->country_id;
            $product->user_id      = $product->user_id;
            $product->save();
            if ($product->save()){
                if($product->country_id  == 230){
                    $rate = Country::where('id', 230)->first('amount')->amount ?? 500;
                }else{
                    $rate = Country::where('id', 231)->first('amount')->amount ?? 700;
                }

            }else{
                return response()->json([
                    'Message'  => 'County Not Supported'
                ]);
            }
            // if($product->country_id  == 1){
            //     $rate = Rate::where('id', 1)->first()->rate ?? 500;
            // }else{
            //     $rate = Rate::where('id', 2)->first()->rate ?? 700;
            // }
            if ($product->status_id == 3) {
                $transaction = new Transaction();
                $transaction->user_id  =   $product->user_id;
                $transaction->transaction_type_id = 2;
                $transaction->amount = $product->amount * $rate;
                $transaction->reference = "ZAN-".strtoupper(Str::random(5));
                $transaction->save();
                return response()->json([
                    'Message' => 'Payment Successfully Made',
                    'Status'    => 'Paid'
                ]);
            }elseif ($product->status_id == 2) {
                return response()->json([
                    'Message' => 'Trade Decline',
                    'Status'    => 'Decline'
                ]);
            }

        }

    public function allTradeForUser()
    {
        $user = auth('sanctum')->user()->id;
        // return $user;
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('user_id', $user)
        ->get();
        return response()->json([
            'Message' => 'All User Trade',
            'data'    => $product
        ]);
    }

    public function successfulTradeForUser()
    {
        $user = auth('sanctum')->user()->id;
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('user_id', $user)
        ->where('status_id', 3)
        ->get();
        return response()->json([
            'Message' => 'All Successful Trade',
            'data'    => $product
        ]);
    }

    public function pendingTradeForUser()
    {
        $user = auth('sanctum')->user()->id;
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('user_id', $user)
        ->where('status_id', 1)
        ->get();
        return response()->json([
            'Message' => 'All Pending Trade',
            'data'    => $product
        ]);
    }

    public function declineTradeForUser()
    {
        $user = auth('sanctum')->user()->id;
        $product = Product::with(['productImages','productType', 'user','collectionMode', 'eCode', 'status'])
        ->where('user_id', $user)
        ->where('status_id', 2)
        ->get();
        return response()->json([
            'Message' => 'All Decline Trade',
            'data'    => $product
        ]);
    }
}
