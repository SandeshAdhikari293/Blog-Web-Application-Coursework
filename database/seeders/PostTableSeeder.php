<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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

        $p->upvotes()->attach(1);
        $p->upvotes()->attach(2);
        $p->upvotes()->attach(3);


        //Create 50 instances of fake data in the database.
        Post::factory()->count(50)->create();

        //Populate pivot table
        foreach(Post::all() as $post){
            $random = rand(1, 3);
            for($i = 0; $i < $random; $i++){
                $post->upvotes()->attach(User::all()->random()->id);
            }
        }
    }
}
