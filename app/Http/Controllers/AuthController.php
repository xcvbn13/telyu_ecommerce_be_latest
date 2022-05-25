<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use Auth;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // $remember_me = true;

        $check = $request->only('email', 'password');

        if(!Auth::attempt($check)){
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = User::where('email', request('email'))->first();

        if(!isset($user)){
            return response([
                'message' => 'Invalid Email'
            ],403);
        }
        if (!Hash::check(request('password'), $user->password)) {
            return response([
                'message' => 'Invalid Password'
            ],403);
        }

        if(auth()->user()->user_type_id == 2){
            return response([
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('secret')->plainTextToken
            ], 200);
        }
        
    }


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'user_type_id' => 2,
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ]);
    }

    public function user(){
        return response([
            'user' => auth()->user()
        ]);
    }
}
