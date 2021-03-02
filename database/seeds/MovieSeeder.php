<?php

use Illuminate\Database\Seeder;
use App\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
            "title" => "Once Upon A Time ... In Hollywood",
            "user_id"=> "1",
            "genre_id" => "2",
            "description" => "A faded television actor and his stunt double strive to achieve fame and success in the film industry during the final years of Hollywood's Golden Age in 1969 Los Angeles.",
            "rating"=> 9.2,
            "picture" => '/storage/pictures/1577154917.PNG',                
        ]); 
    }
}
