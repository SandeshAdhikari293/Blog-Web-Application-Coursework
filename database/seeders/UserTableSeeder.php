<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Hard-coded example of a user.
        $u = new User;
        $u->name = "Sandesh";
        $u->email = "2035469@swansea.ac.uk";
        $u->password = "n/a";
        $u->is_admin = True;
        $u->save();

        $p = new Profile;
        $p->user_id = $u->id;
        $p->bio = "Hello everyone!";
        $p->save();

        

        //Create 50 instances of fake data in the database.
        User::factory()->count(50)->create();
    }
}
