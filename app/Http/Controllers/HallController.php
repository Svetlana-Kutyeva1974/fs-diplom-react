<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HallController extends Controller
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
        $user = Auth::user();
        if (! $user->is_admin) {
        return redirect('/');
        } else {
            //var_dump($request->validated());//var_dump($request->all());
            $all = $request->all();
            $seats =[];
            for ($i = 1; $i <= 10; $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    $seats["$i,$j"] = ['NORM','VIP', 'FAIL'][array_rand(['NORM','VIP', 'FIRE'])];

                }
            }

            //$seats = json_encode($seats);
            $seats = json_encode(["1,1"=>"NORM","1,2"=>"NORM","1,3"=> "NORM", "1,4"=>"NORM","1,5"=>"NORM","1,6"=> "NORM", "1,7"=>"NORM","1,8"=>"NORM","1,9"=> "NORM","1,10"=>"NORM","1,11"=>"NORM","1,12"=> "NORM", "2,1"=>"NORM","2,2"=>"NORM","2,3"=> "NORM", "2,4"=>"NORM","2,5"=>"NORM","2,6"=> "NORM", "2,7"=>"NORM","2,8"=>"NORM","2,9"=> "NORM","2,10"=>"NORM","2,11"=>"NORM","2,12"=> "NORM", "3,1"=>"NORM","3,2"=>"NORM","3,3"=> "NORM", "3,4"=>"NORM","3,5"=>"NORM","3,6"=> "NORM", "3,7"=>"NORM","3,8"=>"FAIL","3,9"=> "NORM","3,10"=>"NORM","3,11"=>"NORM","3,12"=> "NORM","4,1"=>"NORM","4,2"=>"NORM","4,3"=> "NORM", "4,4"=>"NORM","4,5"=>"NORM","4,6"=> "NORM", "4,7"=>"NORM","4,8"=>"NORM","4,9"=> "NORM","4,10"=>"NORM","4,11"=>"NORM","4,12"=> "NORM","5,1"=>"NORM","5,2"=>"NORM","5,3"=> "NORM", "5,4"=>"NORM","5,5"=>"NORM","5,6"=> "NORM", "5,7"=>"NORM","5,8"=>"NORM","5,9"=> "NORM","5,10"=>"NORM","5,11"=>"FAIL","5,12"=> "NORM","6,1"=>"NORM","6,2"=>"NORM","6,3"=> "NORM", "6,4"=>"NORM","6,5"=>"NORM","6,6"=> "NORM", "6,7"=>"NORM","6,8"=>"NORM","6,9"=> "NORM","6,10"=>"NORM","6,11"=>"NORM","6,12"=> "NORM", "7,1"=>"NORM","7,2"=>"NORM","7,3"=> "NORM", "7,4"=>"NORM","7,5"=>"NORM","7,6"=> "NORM", "7,7"=>"NORM","7,8"=>"NORM","7,9"=> "NORM","7,10"=>"NORM","7,11"=>"FAIL","7,12"=> "NORM", "8,1"=>"NORM","8,2"=>"NORM","8,3"=> "NORM", "8,4"=>"NORM","8,5"=>"NORM","8,6"=> "NORM", "8,7"=>"NORM","8,8"=>"FAIL","8,9"=> "NORM","8,10"=>"NORM","8,11"=>"FAIL","8,12"=> "NORM", "9,1"=>"NORM","9,2"=>"NORM","9,3"=> "NORM", "9,4"=>"NORM","9,5"=>"NORM","9,6"=> "NORM", "9,7"=>"NORM","9,8"=>"NORM","9,9"=> "NORM","9,10"=>"NORM","9,11"=>"NORM","9,12"=> "NORM", "10,1"=>"NORM","10,2"=>"FAIL","10,3"=> "NORM", "10,4"=>"NORM","10,5"=>"NORM","10,6"=> "NORM", "10,7"=>"NORM","10,8"=>"NORM","10,9"=> "NORM","10,10"=>"NORM","10,11"=>"NORM","10,12"=> "NORM"]);


            DB::table('halls')->insert([
                'nameHall' => $request["name"],
                'col' => 12,
                'row' => '10',
                'countVip' => 1000,
                'countNormal' => 500,
                'open'=> false,
                'typeOfSeats' => $seats,
            ]);

            return redirect()->route('admin.home');
            //return redirect()->back();
        }
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
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    //public function show(Hall $hall)
    public function show(Request $request)
    {
        $film = $request->film ?? Film::all()->first();//
        $hall = $request->hall ?? Hall::all()->first();
        $dateChosen = $request->dateChosen ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
        $seance = $request->seance ?? Seance::all()->where('startSeance', Carbon::now())->first();
        $seats = $request->seats ?? Seat::all()->where('seance_id', $seance['id'])->where('hall_id', $hall['id']);

            //dump($seats.'  seatttttt');dump($seat->where('seance_id', $seance['id']));
            //dump($seance['id'].'    по id');
        return view('client.hall', ['seats'=> $seats, 'film' => $film, 'hall' => $hall, 'seance'=> $seance,  'dateChosen'=> $dateChosen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Hall $hall)
    {
        //dump($request->all());
        $hall1 = $request['hall'];
        //dump($request['hall']);

        //dump($hall1['id']);
        //dump(json_decode($request['newTypeOfSeats']));

        $hall_new_decode = json_decode($request['newTypeOfSeats']);
        $hall_decode = json_decode($hall1['typeOfSeats']);
        //dump('Неизмененный масс');
       // dump($hall_decode);

        $i=0;
        foreach ($hall_decode as $key => $value) {
            $hall_decode->{$key} = $hall_new_decode[$i]->{"value"};
            //dump($key."value ".$hall_decode->{$key}."new  ". $hall_new_decode[$i]->{"value"});
            $i++;
        }
        //dump($hall_decode);
        $hall1['typeOfSeats'] = json_encode($hall_decode, JSON_THROW_ON_ERROR);
        //var_dump($hall1);

        $hall=Hall::find($hall1['id']);
        //dump('Нашли ');
        //dump($hall);
        $hall['typeOfSeats'] = $hall1['typeOfSeats'];
        $hall->save();
        //dump('изменилис');
        //dump($hall1['id']);
        //dump($hall);

        //return redirect()->route('admin.index', ['selected_hall' => $hall1['id']]);
        return redirect()->route('admin.home');
        //return view('admin.index',['selected_hall' => $hall1['id'], 'user'=> $request->user, 'films' => $request->films, 'halls' => $request->halls, 'seances'=> $request->seances, 'dateCurrent' => $request->dateCurrent, 'dateChosen'=> $request->dateChosen, 'seats'=> $request->seats]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Request $request, $id)
    public function destroy($id)
    {
        Hall::find($id)->delete();//Hall::find($request->id)->delete();
        //return redirect()->back();
        return redirect()->route('admin.home');
    }
}
