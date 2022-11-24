<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeanceController extends Controller
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
    public function create()
    {
        //
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
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function show(Seance $seance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function edit(Seance $seance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seance $seance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seance $seance)
    {
        //
    }

    public function film()//: JsonResponse
    {
        //try {
            /*$seances = Seance::find(1);
            dump($seances->film);
*/
            /*foreach($seances as $s) {
                $s->film()->where('hall_id','=', 1)->get();
            }*/
            /*$category = Category::find(1);

            foreach ($category->posts as $post) {
                dump($post->title);
            }*/

            /*$films= Film::all();
            return response()->json([
                'success' => true,
                'data' => $films,
            ]);
        } catch (\Exception $e) {
            //error_log($e->getMessage());

            return response()->json([
                'success' => false,
            ], 500);*/
        //}
    }

    public function seances($film_id, $hall_id): \Illuminate\Http\JsonResponse
    {

            $seance= DB::table('seances')->where([['film_id','=', 1],['hall_id', '=', 1]])->get();
            return response()->json([
                'success' => true,
                'data' => $seance,
            ]);
    }
}
