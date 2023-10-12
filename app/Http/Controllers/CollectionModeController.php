<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionModeRequest;
use App\Http\Requests\UpdateCollectionModeRequest;
use App\Models\CollectionMode;

class CollectionModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionMode = CollectionMode::get();
        return response()->json([
            'Message'  => 'Collections Types',
            'data'     => $collectionMode
        ]);
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
     * @param  \App\Http\Requests\StoreCollectionModeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCollectionModeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectionMode  $collectionMode
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionMode $collectionMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CollectionMode  $collectionMode
     * @return \Illuminate\Http\Response
     */
    public function edit(CollectionMode $collectionMode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCollectionModeRequest  $request
     * @param  \App\Models\CollectionMode  $collectionMode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCollectionModeRequest $request, CollectionMode $collectionMode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectionMode  $collectionMode
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionMode $collectionMode)
    {
        //
    }
}
