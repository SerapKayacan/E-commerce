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
    { $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'max:255'],
    ], $this->messages());

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Create a new user
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return redirect()->back()->with('success', 'User added successfully.');
}

protected function messages()
{
    return [
        'name.required' => 'The name field is required.', ];
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
        $user = User::find($id);
        return view('user.edit',["user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user=user::find($id);
        if($user) {
           $user->name=$request->input('name');
            $user->email=$request->input('email');
            $user->password=$request->input('password');
            $user->update();
        }


        return redirect('list_user')->with('success','Student Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
