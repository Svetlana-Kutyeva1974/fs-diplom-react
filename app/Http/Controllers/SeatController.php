<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    //public function edit(Request $request, Seat $seat)
    public function edit (Request $request)
    {
        //изменить у выбранных мест параметры в базе+ определить стоимость//dump($request->all());
        $film = $request['film'] ?? Film::all()->first();//$request['amp;dateChosen']
        $hall = $request['hall'] ?? Hall::all()->first();
        $hall_decode = json_decode($hall['typeOfSeats'], true);// хочу массив , тогда true
        $dateChosen = $request['dateChosen'] ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
        $seance = $request['seance'] ?? Seance::all()->where('startSeance', Carbon::now())->first();
        $seatnull= ($seance == null) ? null : Seat::all()->where('seance_id', $seance['id'])->where('hall_id', $hall['id']);
        $seats = $request['seats'] ?? $seatnull;
        $selected = $request['selected'] ?? [];
        //dump($selected);//dump(json_decode($selected));//dump(json_decode($selected)[0]);//dump(count(json_decode($selected)));
        //dump(explode(',',  json_decode($selected)[0]));//dump((int)explode(',',  json_decode($selected)[0])[0]);

        $seatts =[];
        for ($i = 0, $iMax = count(json_decode($selected)); $i < $iMax; $i ++) {
            $seatts[]= Seat::all()->where('seance_id', $seance['id'])->where('hall_id', $hall['id'])->where('rowNumber', (int) explode(',',  json_decode($selected)[$i])[0])->where('colNumber', (int) explode(',', json_decode($selected)[$i])[1])->first();
            //dump($seatts);dump($seatts[$i]);
        }
       // dump('сколько выбрано мест'.count($seatts));//
        $ticket= count(Ticket::all());
        $count_ticket = 0;

        for ($i = 0, $iMax = count($seatts); $i < $iMax; $i ++) {
            //var_dump($seatts[$i]);dump($seatts[$i]);//var_dump($seatts[$i]['free']);dump($seatts[$i]['ticket_id']);
            $seatts[$i]["free"]= "0";
            $seatts[$i]["ticket_id"]= (string) ($ticket+1);
            $ticket++;
            $ij = $seatts[$i]['rowNumber'].','.$seatts[$i]['colNumber'];
            //dd($ij);
            if($hall_decode[$ij]==='NORM') {
                $count_ticket += $hall['countNormal'];
            }
            if($hall_decode[$ij]==='VIP') {
                $count_ticket += $hall['countVip'];
            }

            $seatts[$i]->save();//$this->update($seatts[$i]);
        }
        //dump('изменили');//dd($seatts);dd($count_ticket);//return redirect()->route('client.ticket',['count'=> $count_ticket,'selected'=> $selected, 'film' => $film, 'hall' => $hall, 'seance'=> $seance, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
        return redirect()->route('client.ticket.create',['count'=> $count_ticket,'selected'=> $selected, 'film' => $film, 'hall' => $hall, 'seance'=> $seance, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        //$seat->fill($request->validated());
        //return $seat->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
