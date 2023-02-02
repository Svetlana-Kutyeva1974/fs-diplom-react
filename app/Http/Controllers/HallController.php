<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomDatabaseException;
use App\Http\Requests\HallCreateRequest;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use Throwable;

class HallController extends Controller
{

    public function editHallSeats(Hall $hall, array $json_seat)
    {
        $hall_decode = json_decode($hall['typeOfSeats']);
        $max_row = ($json_seat[0] !=0 ) ? $json_seat[0] : $hall['row'] ;
        $max_col = ($json_seat[1] != 0 ) ? $json_seat[1] : $hall['col'] ;
        $seats =[];
            for ($i = 1; $i <= $max_row; $i++) {
                //$seats =[$i][];
                for ($j = 1; $j <= $max_col; $j++) {
                    $seats["$i,$j"] = $hall_decode->{"$i,$j"} ?? "NORM";
                    //dump($seats["$i,$j"]);
                }
            }
            $seats = json_encode($seats);
        return $seats;
    }
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
    public function create(HallCreateRequest $request)
    {
        try {
            $user = Auth::user();
            if (!$user->is_admin) {
                return redirect('/');
            } else {
                $all = $request->all();
                $seats = [];
                for ($i = 1; $i <= 10; $i++) {
                    for ($j = 1; $j <= 12; $j++) {
                        $seats["$i,$j"] = ['NORM', 'VIP', 'FAIL'][array_rand(['NORM', 'VIP', 'FIRE'])];
                    }
                }

                $seats = json_encode(["1,1" => "NORM", "1,2" => "NORM", "1,3" => "NORM", "1,4" => "NORM", "1,5" => "NORM", "1,6" => "NORM", "1,7" => "NORM", "1,8" => "NORM", "1,9" => "NORM", "1,10" => "NORM", "1,11" => "NORM", "1,12" => "NORM", "2,1" => "NORM", "2,2" => "NORM", "2,3" => "NORM", "2,4" => "NORM", "2,5" => "NORM", "2,6" => "NORM", "2,7" => "NORM", "2,8" => "NORM", "2,9" => "NORM", "2,10" => "NORM", "2,11" => "NORM", "2,12" => "NORM", "3,1" => "NORM", "3,2" => "NORM", "3,3" => "NORM", "3,4" => "NORM", "3,5" => "NORM", "3,6" => "NORM", "3,7" => "NORM", "3,8" => "NORM", "3,9" => "NORM", "3,10" => "NORM", "3,11" => "NORM", "3,12" => "NORM", "4,1" => "NORM", "4,2" => "NORM", "4,3" => "NORM", "4,4" => "NORM", "4,5" => "NORM", "4,6" => "NORM", "4,7" => "NORM", "4,8" => "NORM", "4,9" => "NORM", "4,10" => "NORM", "4,11" => "NORM", "4,12" => "NORM", "5,1" => "NORM", "5,2" => "NORM", "5,3" => "NORM", "5,4" => "NORM", "5,5" => "NORM", "5,6" => "NORM", "5,7" => "NORM", "5,8" => "NORM", "5,9" => "NORM", "5,10" => "NORM", "5,11" => "NORM", "5,12" => "NORM", "6,1" => "NORM", "6,2" => "NORM", "6,3" => "NORM", "6,4" => "NORM", "6,5" => "NORM", "6,6" => "NORM", "6,7" => "NORM", "6,8" => "NORM", "6,9" => "NORM", "6,10" => "NORM", "6,11" => "NORM", "6,12" => "NORM", "7,1" => "NORM", "7,2" => "NORM", "7,3" => "NORM", "7,4" => "NORM", "7,5" => "NORM", "7,6" => "NORM", "7,7" => "NORM", "7,8" => "NORM", "7,9" => "NORM", "7,10" => "NORM", "7,11" => "NORM", "7,12" => "NORM", "8,1" => "NORM", "8,2" => "NORM", "8,3" => "NORM", "8,4" => "NORM", "8,5" => "NORM", "8,6" => "NORM", "8,7" => "NORM", "8,8" => "NORM", "8,9" => "NORM", "8,10" => "NORM", "8,11" => "NORM", "8,12" => "NORM", "9,1" => "NORM", "9,2" => "NORM", "9,3" => "NORM", "9,4" => "NORM", "9,5" => "NORM", "9,6" => "NORM", "9,7" => "NORM", "9,8" => "NORM", "9,9" => "NORM", "9,10" => "NORM", "9,11" => "NORM", "9,12" => "NORM", "10,1" => "NORM", "10,2" => "NORM", "10,3" => "NORM", "10,4" => "NORM", "10,5" => "NORM", "10,6" => "NORM", "10,7" => "NORM", "10,8" => "NORM", "10,9" => "NORM", "10,10" => "NORM", "10,11" => "NORM", "10,12" => "NORM"]);

                DB::table('halls')->insert([
                    'nameHall' => $request["name"],
                    'col' => 12,
                    'row' => '10',
                    'countVip' => 1000,
                    'countNormal' => 500,
                    'open' => false,
                    'typeOfSeats' => $seats,
                ]);

                $conf = $request['confstep'] ?: ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'];
                $conf[0] = 'conf-step__header_opened';
                return redirect()->route('admin.home')->with(['confstep' => $conf]);// нельзя передать

            }
        } catch (\Exception $exception) {
            throw new CustomDatabaseException($exception->getMessage());
        }

        $conf = $request['confstep'] ?: ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'];
        $conf[0] = 'conf-step__header_opened';
        return redirect()->route('admin.home')->with(['confstep' => $conf]);

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
        //Показ конфигурации зала для выбора мест
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
        $json_seat = json_decode($request['json_seat']);
        $hall1 = $request['hall'];
        $hall_new_decode = json_decode($request['newTypeOfSeats']);
        $hall_decode = json_decode($hall1['typeOfSeats']);
        $i=0;
        foreach ($hall_decode as $key => $value) {
            //dump($i);dump($key);dump($hall_new_decode[$i]->{"value"});
            $hall_decode->{$key} = $hall_new_decode[$i]->{"value"};
            //dump($key."value ".$hall_decode->{$key}."new  ". $hall_new_decode[$i]->{"value"});
            $i++;
            //if($i===100) {dump('i=105');}
        }
        $hall1['typeOfSeats'] = json_encode($hall_decode, JSON_THROW_ON_ERROR);

        $hall=Hall::find($hall1['id']);
        $hall['typeOfSeats'] = $hall1['typeOfSeats'];


        // А если было больше: убрать/ Если было меньше добавить seats?
        if ($json_seat[1] !=0 && $json_seat[1] !=$hall->col ) {
            $hall['typeOfSeats'] = $this->editHallSeats($hall, $json_seat);

        }
        if ($json_seat[0] != 0 && $json_seat[0] !=$hall->row) {
            $hall['typeOfSeats']= $this->editHallSeats($hall, $json_seat);

        }
        // сохраняем новое количество рядов в новом зале...
        if ($json_seat[1] != 0) {
            $hall['col'] = $json_seat[1];
        }
        if ($json_seat[0] != 0) {
            $hall['row'] = $json_seat[0];
        }

        $hall->save();

        $confstep= $request['confstep'] ?? ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'];
        $confstep[1]= 'conf-step__header_opened';

        return redirect()->route('admin.home', ['confstep'=> $confstep, 'open'=> $hall['open'], 'selected_hall' => $hall['id']]);
    }

    public function editPriceHall(Request $request, Hall $hall)
    {
        $hall1 = $request['hall'];
        $hall = Hall::find($hall1['id']);
        $count = json_decode($request['count']);
        if ($count[1] != 0) {
            $hall['countVip'] = $count[1];
        }
        if ($count[0] != 0) {
            $hall['countNormal'] = $count[0];
        }
        $hall->save();

        $confstep= $request['confstep'] ?? ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'];
        $confstep[2]= 'conf-step__header_opened';
        //кстати,интересно, open  , selected_hall реально не даны, но они как-то схватываются?
        //лучше сделать $hall['open'], $hall['id']:::
        return redirect()->route('admin.home', ['confstep'=> $confstep, 'open'=> $hall['open'], 'selected_hall' => $hall['id']]);
        //return redirect()->route('admin.home');//это тоже работает?
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
        $hall = Hall::find($id);
        if(count($hall->seances)>0){
            //dd('');
            return redirect()->back()->with('status','Ошибка удаления : В зале ' ."/".$hall->nameHall. "/".' существуют сеансы');
        } else {
            Hall::find($id)->delete();//Hall::find($request->id)->delete();
            return redirect()->route('admin.home');
        }
    }

    /**
     * opem/close the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function open($param)
    {
        //закрытие продаж
        $halls= DB::table('halls')->get();
        foreach($halls as $hall) {
            $new = Hall::find($hall->id);
            $new->open = $param;
            $new->save();
        }

        return redirect()->route('admin.home', [ 'open'=> $param]);
    }
}
