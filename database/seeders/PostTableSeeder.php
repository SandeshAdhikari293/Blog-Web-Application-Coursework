<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Hard-coded example of a post.
        $p = new Post;
        $p->title = "Example Post";
        $p->content = "This is an example post";
        $p->user_id = 1;
        $p->save();

        //Create 50 instances of fake data in the database.
        Post::factory()->count(50)->create();

    }
}
