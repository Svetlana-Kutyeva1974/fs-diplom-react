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
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $films = DB::table('films')->get();
        $seances = DB::table('seances')->get();
        $halls = DB::table('halls')->get();
        $seats = DB::table('seats')->get();
        $seances1 = Seance::all();
        $fl = Film::all()->first();
        //dump($fl);
        //dump($seances1);
        //dump($seances1[0]->where('film_id','=', 1)->where('hall_id', '=', 2)->get());
        //dump(DB::table('seances')->where('film_id','=', 1)->where('hall_id', '=', 2)->get());
        /*foreach ($seances1[0]->film as $post) {
            dump($post);
        }*/

        $films_hall_seance = [
            'first'=> [DB::table('seances')->where([['film_id','=', 1],['hall_id', '=', 1]])->get(),
                DB::table('seances')->where([['film_id','=', 2],['hall_id', '=', 1]])->get(),
                DB::table('seances')->where([['film_id','=', 3],['hall_id', '=', 1]])->get()],
            'second'=> [DB::table('seances')->where([['film_id','=', 1],['hall_id', '=', 2]])->get(),
                        DB::table('seances')->where([['film_id','=', 2],['hall_id', '=', 2]])->get(),
                        DB::table('seances')->where([['film_id','=', 3],['hall_id', '=', 2]])->get()]
        ];
        //dump($films_hall_seance);
        //dump($films_hall_seance['first'][0][0]);
        //dump($films_hall_seance['first'][0][0]->id);
        $dateCarrent = Carbon::now();
        //dump(substr($dateCarrent, 0, 10 ));
        $dataCurrent = substr('2022-12-05 16:00:22', 0, 10);
        //dump($dataCurrent);
        return view('index',['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dataCurrent]);
    }
}
