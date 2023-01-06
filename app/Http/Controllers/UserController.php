<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    //

    public function index($page)
    {
        $users = User::all();
        
        return view('users.index', ['users' => $users, 'page' => $page]);
    }

    public function show($id, $ppage, $cpage)
    {
        $user = User::findOrFail($id);
        if($user->profile == null){
            $user->profile = new Profile();
        }
        return view('users.show', ['user' => $user, 'ppage' => $ppage, 'cpage' => $cpage]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function profile($id){
        $user = User::findOrFail($id);
        return view('users.profile', ['user' => $user]);
    }

    public function store_profile(Request $request){
        // dd($request);

        $user = \Auth::user();
        if($user->profile == null){
            $profile = new Profile;
            $profile->user_id = \Auth::user()->id;
            $profile->save();
            $user->profile = $profile;

        }

        // dd($request);

        $validatedData = $request->validate([
            'bio' => 'nullable|max:255',
            'job' => 'nullable|max:16',
            'dob' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        
        $p = \Auth::user()->profile;
        $p->bio = $validatedData['bio'];
        $p->job = $validatedData['job'];
        $p->dob = $validatedData['dob'];
        $p->user_id = \Auth::user()->id;

        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move(public_path('image'), $filename);

            // $p->avatar = $filename;

            $p->image()->create(['imageable_id' => $p->id, 'url' => $filename]);
        };
        $p->update();


        session()->flash('message', 'Post was created');


        return redirect()->route('users.show', ['id' => \Auth::user()->id, 'cpage' => 1, 'ppage' => 1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index', ['page' => 1])->with('message', 'User was deleted!');
    }

    public function make_admin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = 1;
        $user->update();

        return redirect()->route('users.show', ['id' => $id, 'cpage' => 1, 'ppage' => 1]);
    }

    public function remove_admin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = 0;
        $user->update();

        return redirect()->route('users.show', ['id' => $id, 'cpage' => 1, 'ppage' => 1]);
    }
}