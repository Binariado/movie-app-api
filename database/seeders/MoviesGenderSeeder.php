<?php

namespace Database\Seeders;

use App\Models\MoviesGender;
use Illuminate\Database\Seeder;

class MoviesGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genderMovie = array(
            array(
                "name" => "Humor",
                "position"=> 2
            ),
            array(
                "name" => "Acción",
                "position"=> 1
            ),
            array(
                "name" => "Romance",
                "position"=> 3
            )
        );

        foreach ($genderMovie as $value) {
            MoviesGender::create($value);
        }
    }
}
