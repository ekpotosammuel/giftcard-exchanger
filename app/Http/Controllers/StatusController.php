<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Status;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::get();
        return response()->json([
            'Message'   => 'All Status Field',
            'data'      => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusRequest $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $status = new Status();
        $status->name = $request->input('name');
        $status->save();
        return response()->json([
            'Message'   => 'Status Added',
            'data'      => $status
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status, $id)
    {
        $status = Status::findorFail($id);
        return response()->json([
            'Message'   => "Single Record",
            'data'      => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatusRequest  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusRequest $request, Status $status, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $status = Status::findorFail($id);
        $status->name = $request->input('name');
        $status->save();
        return response()->json([
            'Message'   => 'Status Added',
            'data'      => $status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
