<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('user.list', ['users' => $users]);
    }



    public function create()
    {
        return view('user.add');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:255']

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->slug = Str::slug($request->name);
        $user->save();
        $user->slug = Str::slug($request->name) . '-' . $user->id;
        $user->update();

        return redirect()->route('user.list')->with('success', 'User added successfully.');
    }




    public function edit(string $slug)
    {
        $user = User::where('slug', $slug)->first();
        if(!$user){
            abort(404);
        }
        return view('user.edit', ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => [ 'string', 'min:6', 'max:255', 'nullable']

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);

        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if(!empty($request->input('password'))) {
               $user->password = bcrypt($request->input('password'));
            }
            $user->slug = Str::slug($request->name) . '-' . $user->id;
            $user->update();
        }


        return redirect()->route('user.list')->with('success', 'User Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::withTrashed()->find($id);

        if ($user->trashed()) {
            $user->forceDelete();
            return redirect()->route('user.archive');
        }
        $user->delete();

        return redirect()->route('user.list')->with('success', 'User Deleted Successfully');
    }

    public function archive()
    {
        $users = User::onlyTrashed()->get();
        return view('user.archive', ['users' => $users]);
    }

    public function restore(User $user, Request $request, string $id)
    {
        $user = User::withTrashed()->find($id);

        $user->restore();
        return redirect()->route('user.archive')->with('success', 'User Restored Successfully');;
    }
}
