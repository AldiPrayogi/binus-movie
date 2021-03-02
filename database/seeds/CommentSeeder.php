<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            "movieId" => "1",
            "userId" => "2",
            "movieComment" => "Great movie, funny and refreshing. A must watch!"
        ]);
    }
}
