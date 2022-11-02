<?php

namespace App\Http\Controllers;

//use App\Models\Film;
use App\Models\Film;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;

class IndexController extends Controller
{
    //public function index(Request $request)//: JsonResponse
    public function __invoke(Request $request)
    {
        dump($request->all());//
        $films = DB::table('films')->get();
        $seances = DB::table('seances')->get();
        $halls = DB::table('halls')->get();
        $seats = DB::table('seats')->get();
        $seances1 = Seance::all();
        $fl = Film::all()->first();
        //'dateCurrent' => substr('2022-12-05 16:00:22', 0, 10)
        $dateCurrent = $request->dateCurrent ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
        $dateChosen = $request->dateChosen ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
        dump($seats);
        //dd($dateCurrent);
        return view('index',['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
    }

    public function show(Film $film)
    {
        //
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    //public function __invoke(Request $request)
    /*{
        $films = DB::table('films')->get();
        $seances = DB::table('seances')->get();
        $halls = DB::table('halls')->get();
        $seats = DB::table('seats')->get();
        $seances1 = Seance::all();
        $fl = Film::all()->first();
     //   return view('index',['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => substr('2022-12-05 16:00:22', 0, 10), 'dateChosen'=> substr('2022-12-05 16:00:22', 0, 10)]);
    }*/

}
