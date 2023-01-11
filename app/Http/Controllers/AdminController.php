<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use mysql_xdevapi\Collection;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        //dump($user);
        dump($request->all());

        /*if (! $user->is_admin) {
        return redirect('/');
        }*/
        //return view('admin.home', compact('user'));

            $films = DB::table('films')->get();
            $seances = DB::table('seances')->get();
            $halls = DB::table('halls')->get();
            $seats = DB::table('seats')->get();
            //$seances1 = Seance::all();$fl = Film::all()->first();
            $dateCurrent = $request->dateCurrent ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
            $dateChosen = $request->dateChosen ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
            //dump($halls);dump($halls->first());dump(Hall::all()->first()->seances);

            $hall_holy =  $halls->first()->id;
            $i=0;
            foreach (Hall::all() as $value) {
                $value;
                //dump($value);
                if(count($value->seances)<=0) {
                  $hall_holy = $value->id;
                  break;
                }
                $i++;
            }

            dump($hall_holy);
        //dd();

            $selected_hall = ($request->selected_hall) ?: $hall_holy;
            //было так первый зал выбирался по умолчанию! $selected_hall = ($request->selected_hall) ?: $halls->first()->id;

        //dump($selected_hall);
        //dump($halls->first()->id);



            //dump('request2    ');
           //dump($request->selected_hall);
        //dump('zal vib    ');
        //var_dump(Hall::all()->where('id',$selected_hall)->first());
        //var_dump(Hall::all()->where('id',$selected_hall)->first()->id);
        //dump($halls->where('id',$selected_hall)[1]);!!! нельзя так, офсет будет разный у залов , правильно, как выше

        //dump($halls->where('id',$selected_hall)->first());
        //dump($halls->where('id',$selected_hall)->first()->id);

            //dump($halls[$selected_hall]);//здесь не по id а по порядку номеров в коллекции второй по id это первый!
            //dump($halls[$selected_hall]->id);
        //dump('новое selected-hall  ');
            //var_dump($selected_hall);
            //dump($seats->first());
            //dump($seances);
        /*if($param === 1) {
            $text = "Приостановить продажу билетов";
        } else {
            $text = "Открыть продажу билетов";
        }*/
            $open = $request->open;
            //var_dump($open);
            if ($request->open === null) return redirect()->route('admin.open', ['param' => 0]);
            $text= ($request->open == null || $request->open == '0' ) ? 'Открыть продажу билетов' : 'Приостановить продажу билетов'  ;

            //dump(Route::currentRouteName());
            //dump(Route::getCurrentRoute());

            //dump($request->all());
            //dump($text);
            //if($this->route->hasRoute('admin.open'))
            //var_dump($halls);
            dump($request->confstep);
            $i = session()->get('confstep');
            dump($i);
            $confstep = $request['confstep'] ?: ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'];
            dump($confstep);
            return view('admin.home', ['confstep'=> $confstep ,'open'=> $open, 'text'=> $text ,'selected_hall' => $selected_hall, 'user'=> $user, 'films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Admin::create([
            'name' => Str::random(16).'user',
            'email' => Hash::make('секрет').'@gmail.ru',
            'password' => Hash::make('секрет'),
        ]);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

}
//https://codepen.io/webdevtips-ru/pen/OJmydVd
