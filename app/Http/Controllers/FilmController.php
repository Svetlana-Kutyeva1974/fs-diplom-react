<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     *///@return \Illuminate\Http\Response
    public function index()//: JsonResponse
    {
        try {
        $films = Film::all();
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
    public function store(Request $request): JsonResponse
    {
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
        }
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
    public function destroy($id): JsonResponse
        //public function destroy(Film $film): JsonResponse
    {
        try {
            Film::destroy([$id]);
            return response()->json([
                'status' => 'ok',
            ]);
        }catch (\Exception $e) {
            //error_log($e->getMessage());
            return response()->json([
                'status' => 'error',
            ], 500);
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
