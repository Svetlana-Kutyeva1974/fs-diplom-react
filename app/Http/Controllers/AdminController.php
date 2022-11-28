<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Film;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            //$selected_hall = '';
            $selected_hall =  ($request->selected_hall) ?? '1';
            //dump($halls);//dump($user);//dd($dateChosen);//dd($selected_hall);
            return view('admin.home', ['selected_hall' => $selected_hall, 'user'=> $user, 'films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen, 'seats'=> $seats]);
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
