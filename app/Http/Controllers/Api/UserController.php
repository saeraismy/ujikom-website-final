<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        if($users->count() > 0)
        {
            return UserResource::collection($users);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No users found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User Created Successfully',
            'data' => new UserResource($user),
        ], 201);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];

        if ($request->has('password')) {
            $rules['password'] = 'required|min:5';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $userData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->has('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        return response()->json([
            'message' => 'User Updated Successfully',
            'data' => new UserResource($user),
        ], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User Deleted Successfully',
        ], 200);
    }
}
