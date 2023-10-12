<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\TicketImage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket = Ticket::get();
        return response()->json([
            'Message' => 'All Complains',
            'data'     => $ticket
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $user = auth('sanctum')->user();
        $this->validate($request,[
            'subject'        => 'required',
            'ticket_type_id' => 'required',
            'complains'      => 'required',
            'image'          => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        $ticket = new Ticket();
        $ticket->subject = $request->input('subject');
        $ticket->user_id = $user->id;
        $ticket->ticket_type_id = $request->input('ticket_type_id');
        $ticket->complains = $request->input('complains');
        if($request->file('image')){
            $ticket_image = $request->file('image')->store('public/ticket');
            $ticket_url = str_replace("public", "storage", $ticket_image);
            $image = env("APP_URL")."/".$ticket_url;
            $ticket->image = $image;
        }
        $ticket->save();
        return response()->json([
            'Message'   => 'Ticket Successfully Created',
            'date'      => $ticket
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
