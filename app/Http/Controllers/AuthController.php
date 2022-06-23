<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\User;
// use Auth;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|password',
        ]);

        // $remember_me = true;

        $check = $request->only('email', 'password');
        Auth::attempt($check);
    
        if(auth()->user()->user_type_id == 2){
            return response([
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('secret')->plainTextToken
            ], 200);
        }else{
            return response([
                'message' => "admin user can't access"
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

        $check = $request->only('email', 'password');

        Auth::attempt($check);

        $cart = Cart::create([
            'id_user' => auth()->user()->id,
            'id_status_cart' => 1,
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ],200);
    }

    public function user(){
        return response([
            'user' => auth()->user()
        ],200);
    }
}
