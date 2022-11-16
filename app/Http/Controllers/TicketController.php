<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dump($request->all());
        $film = $request['film'] ?? Film::all()->first();//$request['amp;dateChosen']
        $hall = $request['hall'] ?? Hall::all()->first();
        //dump($request['amp;film']);
        $dateChosen = $request['dateChosen'] ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
        //dump($dateChosen);
        $seance = $request['seance'] ?? Seance::all()->where('startSeance', Carbon::now())->first();
       // dump($seance);

        //dd($selected);
        $seatnull= ($seance == null) ? null : Seat::all()->where('seance_id', $seance['id'])->where('hall_id', $hall['id']);
         //dump($seatnull);
        $seats = $request['seats'] ?? $seatnull;
        //dump($request['amp;seats']);
        $selected = $request['selected'] ?? [];

        //dump(json_decode($selected));
        return view('client.ticket',['selected'=> $selected, 'film' => $film, 'hall' => $hall, 'seance'=> $seance, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tiket = new Ticket();//return Ticket::create($request->validated());
        Ticket::create([
            'qrCode' => $request['data'],//Str::random(16).'user',
            'film_id' => $request['film_id'],
            'seat_id' => $request['seat_id'],//Hash::make('секрет').'@gmail.ru',
            'seance_id' => $request['seance_id'],//Hash::make('секрет'),
            'created_at' => date("Y-m-d H:i:s"),//Carbon::now()
            'updated_at' => date("Y-m-d H:i:s"),//Carbon::now()
        ]);
        return redirect()->route('ticket');

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
