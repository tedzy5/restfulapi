<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function login(Request $request) {
        $val = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $val['email'])->first();
        if(!$user) {
            return response()->json(['message' => 'Email login is wrong.']);
        } else {
            if(!Hash::check($val['password'], $user->password)) {
                return response()->json(['message' => 'Wrong password.']);
            }
        }

        $token = $user->createToken('H3||0')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function register(Request $request) {
        $val = $request->validate([
            'fullname' => 'required|min:5|max:15|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'type' => 'required|numeric'
        ]);

        $user = User::create([
            'fullname' => $val['fullname'],
            'email' => $val['email'],
            'password' => bcrypt($val['password']),
            'type' => $val['type']
        ]);

        $token = $user->createToken('H3||0')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Token successfully deleted.']);
    }
}
