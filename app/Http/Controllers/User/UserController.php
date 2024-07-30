<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('user.list', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255','nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','nullable'],
            'password' => ['required', 'string', 'min:6', 'max:255','nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('user.list')->with('success', 'User added successfully.');
    }

    public function archive()
    {
        $users = User::onlyTrashed()->get();
        return view('user.archive', ['users' => $users]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255','nullable'],
            'email' => ['required', 'string', 'email', 'max:255','nullable', 'unique:users,email,'.$id],
            'password' => [ 'string', 'min:6', 'max:255','nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->has('password');//ı changed here has to prevent validation null error.
            $user->update();
        }


        return redirect()->route('user.list')->with('success', 'User Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $user = User::find($id);


        if ($user->trashed('user.delete')) {
            $user->forceDelete();
            return redirect()->route('user.archive');

        }
        $user->delete();
        return redirect()->route('user.list')->with('success', 'User Deleted Successfully');
    }



    public function restore(User $user, Request $request,string $id){
        $user = User::find($id);
        $user->restore();
        return redirect()->route('user.archive')->with('success', 'User Restored Successfully');;
    }





}

