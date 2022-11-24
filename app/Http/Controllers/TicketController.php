<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use PHPQRCode;
use QRcode;

//use QRCode;

require_once base_path() . '\phpqrcode\qrlib.php';

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $film = $request['film'] ?? Film::all()->first();
        $hall = $request['hall'] ?? Hall::all()->first();
        $dateChosen = $request['dateChosen'] ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
        $seance = $request['seance'] ?? Seance::all()->where('startSeance', Carbon::now())->first();
        $seatnull= ($seance == null) ? null : Seat::all()->where('seance_id', $seance['id'])->where('hall_id', $hall['id']);
        $seats = $request['seats'] ?? $seatnull;
        $selected = $request['selected'] ?? [];
        $count_ticket = $request['count'] ?? [];
        $qrCod = $request['qrCod'] ?? [];
        return view('client.ticket',[ 'qrCod'=> $qrCod, 'count'=> $count_ticket, 'selected'=> $selected, 'film' => $film, 'hall' => $hall, 'seance'=> $seance, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return //\Illuminate\Http\Response
     */
    public function create(Request $request, Ticket $ticket)
    {
        //$ticket = new Ticket();//return Ticket::create($request->validated());
        //Ticket::create([
        //dump($request->all());

        $film = $request['film'] ?? Film::all()->first();
        $hall = $request['hall'] ?? Hall::all()->first();
        $selected = $request['selected'] ?? [];
        $count_ticket = $request['count'] ?? [];
        $seance = $request['seance'] ?? Seance::all()->where('startSeance', Carbon::now())->first();
        $seatnull= ($seance == null) ? null : Seat::all()->where('seance_id', $seance['id'])->where('hall_id', $hall['id']);
        $seats = $request['seats'] ?? $seatnull;
        $dateChosen = $request['dateChosen'] ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'

        //Подготовка qr

        $string = 'зал: '.$hall['nameHall'].', фильм: '.$film['title'].', начало сеанса: '.substr($seance['startSeance'], -8, 5).', стоимость билета: '.$count_ticket;
                foreach(json_decode($selected) as $item) {

                    //Подготовка строки кодировки
                    $int = (int)$hall['col'];
                    $string .= ", ряд " . explode(',', $item)[0] . " место" . (explode(',', $item)[1] + (explode(',', $item)[0] - 1) * $int);
                }

        DB::table('tickets')->insert([
            'qrCod' => $string,
            'film_id' => $film['id'],
            'count' => $request['count'],
            'seance_id' => $seance['id'],//Hash::make('секрет'),
            'created_at' => Carbon::now(), //date("Y-m-d H:i:s"),//Carbon::now()
            'updated_at' => Carbon::now(),//date("Y-m-d H:i:s"),//Carbon::now()
        ]);
        return redirect()->route('client.ticket',['qrCod'=> $string, 'count'=> $count_ticket, 'selected'=> $selected, 'film' => $film, 'hall' => $hall, 'seance'=> $seance, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
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
    public function edit(Ticket $ticket)
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
