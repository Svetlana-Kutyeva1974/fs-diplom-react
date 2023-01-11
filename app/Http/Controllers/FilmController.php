<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmCreateRequest;
use App\Models\Film;
use App\Models\Hall;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response//
     *///@return \Illuminate\Http\Response
    public function index(Request $request)
    {

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FilmCreateRequest $request)
    {
        var_dump($request->all());//
        dump('image path ');
        dump($request["imagePath"]);
        if ($request->isMethod('post') && $request->file('imagePath')) {

            $file = $request->file('imagePath');
            dump('basename ');
            dump($request->file('imagePath'));
            $upload_folder = 'public/i';
            $filename = $file->getClientOriginalName(); // image.jpg

            dump($filename);
            Storage::putFileAs($upload_folder, $file, $filename);

        }
        //dd($request->imagePath);
        //$request->imagePath->store('$request->imagePath'); //filename.jpg = $request["imagePath"]
        //dd($path);
        DB::table('films')->insert([
            'title' => $request["title"],
            'description' => $request["description"],
            'duration' => $request["duration"] ?? 130,
            'imagePath' => '/storage/i/'.$filename ?? 'i/poster2.jpg',//$request->imagePath ?? 'i/poster2.jpg',//$path = $request->photo->storeAs('images', 'filename.jpg');
            'imageText' => '' ?? $request["title"],
            'origin'=> $request["origin"] ?? '',
        ]);
        // dd($seats);
        //return redirect()->route('admin.home');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//: JsonResponse
    {
        /*
        try {
            $all = $request->all();
            $newFilm = Film::create($all);
            return response()->json([
                    'success' => true,
                    'data' => $newFilm,
            ]);
        } catch (\Exception $e) {
            //error_log($e->getMessage());
            return response()->json([
                'status' => 'error',
            ], 500);
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
        //public function destroy(Film $film): JsonResponse
    {
        if(count(Film::find($id)->seances)>0){
            //dd('');
            return redirect()->back()->with('status','Ошибка удаления : для фильм ' ."/".Film::find($id)->title. "/".' существуют сеансы');
        } else {
            Film::find($id)->delete();
            return redirect()->back();
        }
    }

    public function seance()//: JsonResponse
    {
        try {
            $films = Film::all();
            foreach ($films as $film) {
                $film->seance()->where('hall_id', '=', 1)->get();
            }
            /*$category = Category::find(1);
            foreach ($category->posts as $post) {
                dump($post->title);
            }*/


            return response()->json([
                'success' => true,
                'data' => $films,
            ]);
        } catch (\Exception $e) {
            //error_log($e->getMessage());

            return response()->json([
                'success' => false,
            ], 500);
        }
    }
}
