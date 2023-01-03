<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function create(Request $request)
    {
        $open= $request->open ?? 0;
        $selected_hall= $request->hall->{'id'} ?? '1';
        $seance_id_last= Seance::all()->last()->id;
        dump($seance_id_last);
        dump($request->all());
        $data = explode(" ", Carbon::now());
        dump($data);
        $data[1]=$request['start_seance'];
        dump($data);
        $data = implode(" ", $data);
        //dd($data);
        //
        DB::table('seances')->insert([
            'film_id' => $request['film_id'],// не нужно, опрределяем через seance
            'hall_id' => $request['hall_id'],
            //'seance_id' => seance_id_last,//Hash::make('секрет'),
            'created_at' => Carbon::now(), //date("Y-m-d H:i:s"),//Carbon::now()
            'updated_at' => Carbon::now(),//date("Y-m-d H:i:s"),//Carbon::now()
            'startSeance'=> $data,
        ]);
        //dd($new_seance);


        // seats создаем для созданного сеанса
        $seance =  Seance::all()->last();
        $hall= $seance->hall;//через отношение получаем зал
        //$hall = Hall::all()->where('id', $seance['hall_id'])->first();
        dump($hall);
        //redirect()->route('admin.createSeat', ['seance'=> $seance]);
        for ($i = 1; $i <= $hall['col']; $i++) {
            for ($j = 1; $j <= $hall['row']; $j++) {

                $seat = new Seat();
                $seat->hall_id = $seance['hall_id'];
                $seat->colNumber = $j;// $seat->colNumber= Hall::all()->where('id', $seance['hall_id'])->col;
                $seat->rowNumber = $i; //Hall::all()->where('id', $seance['hall_id'])->row;
                $seat->ticket_id = 0;
                $seat->seance_id = $seance['id'];//Seance::all()->last()->id;
                $seat->free = true;

                $seance->seats()->save($seat);
                //dd(seat);
            }
        }
        dd($seance);
        return redirect()->route('admin.home', ['open'=> $open, 'selected_hall' => $selected_hall]);
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
