<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserApiController extends Controller
{

    public function index()
    {
        $users = User::all();
        if ($users) {
            return UserResource::collection($users);
        } else {
            return response()->json([
                'message' => 'No record avaible'
            ],404);
        }
    }



    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:255']

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->slug = Str::slug($request->name);
        $user->save();
        $user->slug = Str::slug($request->name) . "-" . $user->id;
        $user->update();

        return response()->json([
            'message' => 'User created succesfully.',
            'data' => new UserResource($user)
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such User Found!'
            ], 404);
        }
    }


    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['string', 'min:6', 'max:255', 'nullable']

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }

        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if (!empty($request->input('password'))) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->slug = Str::slug($request->name) . '-' . $user->id;
            $user->update();
            return response()->json([
                'message' => 'User Updated succesfully.',
                'data' => new UserResource($user)
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Such User Found!'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::withoutTrashed()->find($id);

        if ($user) {

            $user->delete();
            return response()->json([
                'message' => 'User soft deleted successfully.',
                'data' => new UserResource($user)
            ], 200);
        }

        return response()->json(['message' => 'No Such User Found!'], 404);
    }
}
