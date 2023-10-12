<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateRequest;
use App\Http\Requests\UpdateRateRequest;
use App\Models\Rate;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rate = Rate::get();
        return response()->json([
            'Message'   => 'All Currency Rate',
            'Data'      => $rate
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRateRequest $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'amount' => 'required'
        ]);
        $rate = new Rate();
        $rate->name = $request->input('name');
        $rate->amount = $request->input('amount');
        $rate->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate, $id)
    {
        $rate = Rate::findorFail($id);
        return response()->json([
            'Message'   => 'Single Record',
            'Data'      => $rate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRateRequest  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRateRequest $request, Rate $rate, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'amount' => 'required'
        ]);
        $rate = Rate::findorFail($id);
        $rate->name = $request->input('name');
        $rate->amount = $request->input('amount');
        $rate->save();
        return response()->json([
            'Message'   => 'Rate Successfully Updated',
            'Data'      => $rate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function SoftDeletes(Rate $rate, $id)
    {
        $rate = Rate::findorFail($id);
        if($rate->delete()){

            return 'deleted successfully';
        }
    }
}
