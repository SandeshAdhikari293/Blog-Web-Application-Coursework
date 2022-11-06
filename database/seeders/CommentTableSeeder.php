<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Hard-coded example comment
        $c = new Comment();
        $c->text = "This is an example comment.";
        $c->user_id = 1;
        $c->post_id = 1;
        $c->save();

        //Create 50 instances of fake data in the database.
        Comment::factory()->count(50)->create();

    }
}
