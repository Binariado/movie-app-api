<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directors = array(
            array(
                "name" => "Todd Phillips"
            )
        );

        foreach ($directors as $value) {
            Director::create($value);
        }
    }
}
