<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genreName = [
            "Action", "Comedy", "Drama", "Thriller", "Horror"
        ];
        for($i = 0; $i < sizeof($genreName); $i++){
            Genre::create([
                "genreName" => $genreName[$i],
                ]);
        }
    }
}
