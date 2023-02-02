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
            $films = DB::table('films')->get();
            $seances = DB::table('seances')->get();
            $halls = DB::table('halls')->get();
            $seats = DB::table('seats')->get();
            $dateCurrent = $request->dateCurrent ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
            $dateChosen = $request->dateChosen ?? substr(Carbon::now(), 0, 10);//'2022-11-05 16:00:22'
            $hall_holy =  $halls->first()->id;
            $i=0;
            foreach (Hall::all() as $value) {
                $value;
                if(count($value->seances)<=0) {
                  $hall_holy = $value->id;
                  break;
                }
                $i++;
            }
            $selected_hall = ($request->selected_hall) ?: $hall_holy;
            //было так первый зал выбирался по умолчанию! $selected_hall = ($request->selected_hall) ?: $halls->first()->id;

            $open = $request->open;
            if ($request->open === null) return redirect()->route('admin.open', ['param' => 0]);
            $text= ($request->open == null || $request->open == '0' ) ? 'Открыть продажу билетов' : 'Приостановить продажу билетов'  ;

            $i = session()->get('confstep');
            $confstep = $request['confstep'] ?: ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed'];
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

