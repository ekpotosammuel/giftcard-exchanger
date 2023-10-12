<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketTypeRequest;
use App\Http\Requests\UpdateTicketTypeRequest;
use App\Models\TicketType;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketType = TicketType::get();
        return response()->json([
            'Message' => 'All Complains',
            'data'     => $ticketType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketTypeRequest $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $ticketType = new TicketType();
        $ticketType->name = $request->input('name');
        $ticketType->save();
        return response()->json([
            'Message'  => 'Ticket Successfully Created',
            'data'     => $ticketType
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketType  $ticketType
     * @return \Illuminate\Http\Response
     */
    public function show(TicketType $ticketType, $id)
    {
        $ticketType = TicketType::findorFail($id);
        return response()->json([
            'Message'   => 'Single Record',
            'Data'      => $ticketType
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketTypeRequest  $request
     * @param  \App\Models\TicketType  $ticketType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketTypeRequest $request, TicketType $ticketType, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $ticketType = TicketType::findorFail($id);
        $ticketType->name = $request->input('name');
        $ticketType->save();
        return response()->json([
            'Message'  => 'Ticket Successfully Updated',
            'data'     => $ticketType
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function SoftDeletes($id)
    {
        $ticketType = TicketType::findorFail($id);
        if($ticketType->delete()){

            return 'deleted successfully';
        }
    }
}
