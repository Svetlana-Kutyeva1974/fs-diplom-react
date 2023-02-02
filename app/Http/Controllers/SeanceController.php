<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeanceCreateRequest;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeanceController extends Controller
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
    public function create(Request $request)
    {
        $open= $request->open ?? 0;
        $selected_hall= $request->hall->{'id'} ?? '1';
        $seance_id_last= Seance::all()->last()->id;
        $data = explode(" ", Carbon::now());
        $data[1]=$request['start_seance'];

        $data = implode(" ", $data);
        DB::table('seances')->insert([
            'film_id' => $request['film_id'],// не нужно, определяем через seance
            'hall_id' => $request['hall_id'], //'seance_id' => seance_id_last,//Hash::make('секрет'),
            'created_at' => Carbon::now(), //date("Y-m-d H:i:s"),//Carbon::now()
            'updated_at' => Carbon::now(),//date("Y-m-d H:i:s"),//Carbon::now()
            'startSeance'=> $data,
        ]);

        // seats создаем для созданного сеанса
        $seance =  Seance::all()->last();//$hall= $seance->hall;//через отношение можно получить зал
        $hall = Hall::all()->where('id', $seance['hall_id'])->first();
        for ($i = 1; $i <= $hall['row']; $i++) {
            for ($j = 1; $j <= $hall['col']; $j++) {

                $seat = new Seat();
                $seat->hall_id = $seance['hall_id'];
                $seat->colNumber = $j;// $seat->colNumber= Hall::all()->where('id', $seance['hall_id'])->col;
                $seat->rowNumber = $i; //Hall::all()->where('id', $seance['hall_id'])->row;
                $seat->ticket_id = 0;
                $seat->seance_id = $seance['id'];//Seance::all()->last()->id;
                $seat->free = true;

                $seance->seats()->save($seat);
            }
        }

        if($request['confstep']) {
            $confstep = $request['confstep'];
        } else {
            $confstep = ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_opened', 'conf-step__header_closed'];
        }

        //!!!!повтор   cо второго дня  на 14
        for ($dn = 1; $dn <= 13; $dn++) {
            $data = explode(" ", Carbon::now()->addDays($dn));
            $data[1] = $request['start_seance'];
            $data = implode(" ", $data);

            DB::table('seances')->insert([
                'film_id' => $request['film_id'],// не нужно, опрределяем через seance
                'hall_id' => $request['hall_id'],
                'created_at' => Carbon::now()->addMinute(), //date("Y-m-d H:i:s"),//Carbon::now()
                'updated_at' => Carbon::now()->addMinute(),//date("Y-m-d H:i:s"),//Carbon::now()
                'startSeance' => $data,
            ]);

            // seats создаем для созданного сеанса
            $seance = Seance::all()->last();//print_r($seance->id);
            $hall = $seance->hall;//через отношение получаем зал
            for ($ii = 1; $ii <= $hall['row']; $ii++) {
                for ($jj = 1; $jj <= $hall['col']; $jj++) {
                    $seat = new Seat();
                    $seat->hall_id = $seance['hall_id'];
                    $seat->colNumber = $jj;// $seat->colNumber= Hall::all()->where('id', $seance['hall_id'])->col;
                    $seat->rowNumber = $ii; //Hall::all()->where('id', $seance['hall_id'])->row;
                    $seat->ticket_id = 0;
                    $seat->seance_id = $seance['id'];//Seance::all()->last()->id;
                    $seat->free = true;
                    $seance->seats()->save($seat);
                }
            }

        } //for for days
        return redirect()->route('admin.home', ['confstep'=> $confstep, 'open'=> $open, 'selected_hall' => $selected_hall]);
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
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function show(Seance $seance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function edit(Seance $seance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seance $seance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Seance $seance)
    public function destroy($id)
    {
        $seance = Seance::find($id);
        $unique = Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->values();//// все сеансы в зале с выбранным фильмом
        $unique2= Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->unique(function ($item, $key) {
            return substr($item['startSeance'], -8, 5);
        });// все уникальные сеансы в зале с выбранным фильмом
        $r = Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->pluck('startSeance');// все начала сеансов в зале с выбранным фильмом
        $ss=[];//
        for($i=0; $i<count($r); $i++){
            if (substr($r[$i], -8,5) == substr($seance['startSeance'], -8,5)){
                array_push($ss,$unique[$i] );
            }
        }
        foreach($ss as $seance) {
            $seance->seats()->delete();//удаление всех связанных с сеансом мест!!!
            $seance->tickets()->delete();//удаление всех связанных с сеансом билетов!!!
            $seance->delete();//удаление самого сеанса
        }

        return redirect()->route('admin.home');

    }

    public function film()
    {
        //
    }
}
