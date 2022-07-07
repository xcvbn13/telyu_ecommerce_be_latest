<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $review = User::findOrFail($id);
        
        return response([
            'message' => "Berhasil",
            'data' => $review,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $emailUser = $user->email;
        $nameUser = $user->name;
        $alamatUser = $user->alamat;
        $no_telpUser = $user->no_telp;

        if($request->name != null){
            if(strcmp($request->name,$nameUser) != 0){
                $request->validate([
                    'name' => 'required'
                ]);
                $user->name = $request->name;
            }
        }
        if($request->email != null){
            if(strcmp($request->email,$emailUser) != 0){
                $request->validate([
                    'email' => 'required|email|unique:users,email'
                ]);
                $user->email = $request->email;
            }
        }

        if($request->alamat != null){
            if(strcmp($request->alamat,$alamatUser) != 0){
                $request->validate([
                    'alamat' => 'required'
                ]);
                $user->alamat = $request->alamat;
            }
        }
        if($request->no_telp != null){
            if(strcmp($request->no_telp,$no_telpUser) != 0){
                $request->validate([
                    'no_telp' => 'required|numeric'
                ]);
                $user->no_telp = $request->no_telp;
            }
        }
        $user->save();

        return response([
            'message' => "Berhasil",
            'data' => $user,
        ], 200);
    }

    public function update_pass(Request $request){

        $user = auth()->user();
        $passwordUser = $user->password;
        $checkpass = Hash::check($request->oldpassword,$passwordUser);
        
        if($request->oldpassword != null && $request->password != null && $request->password_confirmation != null){
            if(!$checkpass){
                return response([
                    'message' => "Old Password Tidak Cocok",
                ], 400);
            }
            $request->validate([
                'oldpassword' => 'required',
                'password' => 'required|confirmed',
            ]);
            $user->password = Hash::make($request->password);  
            $user->save();
        }

        return response([
            'message' => "Berhasil",
            'data' => $user
        ], 200);
    }

}
