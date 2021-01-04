<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MoviesGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
  use ResponseTrait;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      // $movie = Movie::join("movies_genders", "movies_genders.id", "movies.movies_gender_id")
      //   ->join("directors", "directors.id", "movies.director_id")
      //   ->select(
      //     'movies.id',
      //     "movies.movies_gender_id",
      //     "movies.director_id",
      //     "movies.title",
      //     "movies.description",
      //     DB::raw("movies.img_gallery->'gallery' as img_gallery")
      //   )
      //   ->addSelect("directors.name as name_director")
      //   ->addSelect("movies_genders.name as name_gender")
      //   ->get();
        
       $gender =  MoviesGender::select('*')
       ->orderBy('position', 'asc')
       ->get();
      return $this->success(compact('gender'), 'list movie', 200);
    } catch (\Throwable $th) {
      return $this->error('internal_server_error', 500);
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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function show(Movie $movie)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function edit(Movie $movie)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Movie $movie)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie)
  {
    //
  }
}
