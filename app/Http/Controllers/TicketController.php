<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $tiket
     * @return \Illuminate\Http\Response
     */
    //public function show(Ticket $tiket)
    public function show($seance, $hall, $date)
    {
        try {
            $tickets = Ticket::where('date', '=', $date)
                ->where('seance_id', '=', $seance)->get();
            return response()->json([
                'status' => 'ok',
                'data' => $tickets,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $tiket)
    {
        //
    }
}
