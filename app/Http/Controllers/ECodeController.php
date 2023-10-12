<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreECodeRequest;
use App\Http\Requests\UpdateECodeRequest;
use App\Models\ECode;

class ECodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreECodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreECodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ECode  $eCode
     * @return \Illuminate\Http\Response
     */
    public function show(ECode $eCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ECode  $eCode
     * @return \Illuminate\Http\Response
     */
    public function edit(ECode $eCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateECodeRequest  $request
     * @param  \App\Models\ECode  $eCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateECodeRequest $request, ECode $eCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ECode  $eCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(ECode $eCode)
    {
        //
    }
}
