<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Movie;
use App\Models\MoviesGender;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $gender = MoviesGender::all()->keyBy("id")->keys();
    $directorId = Director::all()->keyBy("id")->keys();
    $movies = array(
      array(
        "movies_gender_id"=> $gender->random(),
        "director_id"=> $directorId->random(),
        "title" => "Joker",
        "description" =>  "Arthur Fleck es un payaso con una extraña enfermedad mental. Responsable del cuidado de su madre enferma, sueña con su propio espectáculo de stand up comedy. Pero ahora que el subestimado y mentalmente enfermo Arthur Fleck ha ganado popularidad",
        "img_gallery"=> json_encode((object) array(
          "gallery" => [
            array(
              "url" => "https://cdn.culturagenial.com/es/imagenes/comment-z96nqkrqqgrlahksgrjsxiivqdpp9xlg-cke.jpg",
            ),
            array(
              "url" => "https://cde.laprensa.e3.pe/ima/0/0/2/3/4/234401.jpg",
            ),
          ]
      )),
      ),
    );

    foreach ($movies as $value) {
        Movie::create($value);
    }

  }
}
