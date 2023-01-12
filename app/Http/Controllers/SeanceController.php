<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeanceCreateRequest;
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
       // dump($data);
        $data[1]=$request['start_seance'];
        //dump($data);
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
        //$hall= $seance->hall;//через отношение получаем зал
        $hall = Hall::all()->where('id', $seance['hall_id'])->first();
        dump($hall);
        //redirect()->route('admin.createSeat', ['seance'=> $seance]);
        for ($i = 1; $i <= $hall['row']; $i++) {
            for ($j = 1; $j <= $hall['col']; $j++) {

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
        //dump($seance);
        if($request['confstep']) {
            $confstep = $request['confstep'];
            //dump($confstep);
        } else {
            $confstep = ['conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_closed', 'conf-step__header_opened', 'conf-step__header_closed'];
        }


        //!!!!повтор
        //for ($dn = 1; $dn <= 13; $dn++) {
            //dump($request->all());
            $data = explode(" ", Carbon::now()->addDays(1));
            //dump($data);
            $data[1] = $request['start_seance'];
            //dump($data);
            $data = implode(" ", $data);
            //dump($data);
            //
            DB::table('seances')->insert([
                'film_id' => $request['film_id'],// не нужно, опрределяем через seance
                'hall_id' => $request['hall_id'],
                'created_at' => Carbon::now()->addMinute(), //date("Y-m-d H:i:s"),//Carbon::now()
                'updated_at' => Carbon::now()->addMinute(),//date("Y-m-d H:i:s"),//Carbon::now()
                'startSeance' => $data,
            ]);
            //dd($new_seance);


            // seats создаем для созданного сеанса
            $seance = Seance::all()->last();
            print_r($seance->id);
            $hall = $seance->hall;//через отношение получаем зал
            //$hall = Hall::all()->where('id', $seance['hall_id'])->first();
            //dump($hall);
            //redirect()->route('admin.createSeat', ['seance'=> $seance]);
            for ($ii = 1; $ii <= $hall['row']; $ii++) {
                for ($jj = 1; $jj <= $hall['col']; $jj++) {
                    //dump(' *************************************** ');
                    //dump($jj);
                    $seat = new Seat();
                    $seat->hall_id = $seance['hall_id'];
                    $seat->colNumber = $jj;// $seat->colNumber= Hall::all()->where('id', $seance['hall_id'])->col;
                    $seat->rowNumber = $ii; //Hall::all()->where('id', $seance['hall_id'])->row;
                    $seat->ticket_id = 0;
                    $seat->seance_id = $seance['id'];//Seance::all()->last()->id;
                    $seat->free = true;

                    $seance->seats()->save($seat);
                    //dump($seat);
                }
            }

        //}

        //dd();
        return redirect()->route('admin.home', ['confstep'=> $confstep, 'open'=> $open, 'selected_hall' => $selected_hall]);
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
    //public function destroy(Seance $seance)
    public function destroy($id)
    {
        //dump($id);
        $seance = Seance::find($id);
        //dump('зал');
        dump(Seance::find($id));
        //$seance->seats()->delete()ж//удаление сеанса с местами!!!
        //dump($seance->seats);
        //dump($seance->tickets);
        $unique = Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->values();//
        $unique2= Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->unique(function ($item, $key) {
            return substr($item['startSeance'], -8, 5);
        });
        //$unique3= Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->reject(function ($item, $seance){
         //   return substr($item['startSeance'], -8, 5) = substr($seance['startSeance'], -8, 5);

        //});
        $r = Seance::all()->where('film_id', $seance['film_id'])->where('hall_id', $seance['hall_id'])->pluck('startSeance');
    //where('startSeance','=', $seance['startSeance']);
        //search(function ($item, $key) {
            //if( substr($item['startSeance'], -8, 5) == substr($seance['startSeance'], -8, 5)) {

            //return $item['startSeance'] <=14;
            //}
        //}, true);
        //where(substr('startSeance', -8, 5), substr($seance['startSeance'], -8, 5));//where(substr('startSeance', -8, 5), substr($seance['startSeance'], -8, 5));//->get();//->values()->all();
        foreach($r as $s) {
            print_r('cccccccccccccccc'.'/n');
            if (substr($s, -8,5) == substr($seance['startSeance'], -8,5)){
                dump( substr($s, -8,5));
            }
        }
        $ss=[];
        for($i=0; $i<count($r); $i++){
            if (substr($r[$i], -8,5) == substr($seance['startSeance'], -8,5)){
                dump( substr($s, -8,5));
                var_dump($i);
                dump($r[$i]);
                dump($unique[$i]);
                array_push($ss,$unique[$i] );
            }
        }
        dump('уникальноеееееееееееееееееееееееееееее'.'/n');
        dump($unique);
        dump($unique2);
        //dump($unique3->all());
        dump($r);
        dump($ss);
        foreach($ss as $seance) {
            $seance->seats()->delete();//удаление всех связанных с сеансом мест!!!
            $seance->tickets()->delete();//удаление всех связанных с сеансом билетов!!!
            $seance->delete();//удаление самого сеанса
        }
        //dd();


        /*
        $seance->seats()->delete();//удаление всех связанных с сеансом мест!!!
        $seance->tickets()->delete();//удаление всех связанных с сеансом билетов!!!
        $seance->delete();//удаление самого сеанса
        */

        return redirect()->route('admin.home');

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
