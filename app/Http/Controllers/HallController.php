<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\ToDo;
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
            //var_dump($request->validated());
            var_dump($request->all());
            var_dump($request["name"]);
            $all = $request->all();
            //$newHall = Hall::create($all);
            dump('zal:');
            //var_dump($newHall);
            $seats =[];
            for ($i = 1; $i <= 10; $i++) {
                //$seats =[$i][];
                for ($j = 1; $j <= 12; $j++) {
                    //$ii="$i$j";
                    $seats["$i,$j"] = ['NORM','VIP', 'FAIL'][array_rand(['NORM','VIP', 'FIRE'])];
                }
            }
            //dump($seats);
            $seats = json_encode($seats);
            //$newHall['typeOfSeats'] = $seats;
            dump('zal:');
            //var_dump($newHall['typeOfSeats']);

            DB::table('halls')->insert([
                'nameHall' => $request["name"],
                'col' => 12,
                'row' => '10',
                'countVip' => 1000,
                'countNormal' => 500,
                'open'=> false,
                'typeOfSeats' => $seats,
            ]);
           // dd($seats);
            //return redirect()->route('admin.home');
            return redirect()->back();
        }
        //return view('admin.ticket',['selected'=> $selected, 'film' => $film, 'hall' => $hall, 'seance'=> $seance, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // {
        //            $all = $request->all();
        //            $newHall = Film::create($all);
        //            return response()->json([
        //                    'success' => true,
        //                    'data' => $newFilm,
        //            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Hall $hall)
    {
        dump($hall);
        dd($request);
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
    public function destroy(Request $request, Hall $hall)
    //public function destroy($id)
    {
        dump($request->all());
        dump($request->id);
        dump($hall);
        //$hall = $hall->delete();
        dump(Hall::find($request->id));
        $hall = Hall::find($request->id)->delete();

        //if ($hall->delete()) {
                  //return response(null, Response::HTTP_NO_CONTENT);
              // }
              // return null;
        return redirect()->back();
    }
}
