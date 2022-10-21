<?php

namespace App\Http\Controllers;

//use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $films = DB::table('films')->get();
        $seances = DB::table('seances')->get();
        $halls = DB::table('halls')->get();

        /*$users = DB::table('users')->get();//Collection::
        dump($users);// массив
        dump($users['0']);//обьект
        dump($users['0']->id);// значение ключа обьекта
        */
        return view('index', compact('films', 'seances', 'halls'));
    }
}
