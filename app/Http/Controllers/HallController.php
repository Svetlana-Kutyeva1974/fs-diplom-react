<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
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

            $seats = json_encode($seats);

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
        dump($request->all());
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
