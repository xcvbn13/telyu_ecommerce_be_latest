<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'data' => $review->password,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $emailUser = $user->email;
        $nameUser = $user->name;
        $passwordUser = $user->password;
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
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->alamat = $request->alamat;
        // $user->no_telp = $request->no_telp;
        $user->save();

        return response([
            'message' => "Berhasil",
            'data' => $user,
        ], 200);
    }

    public function updatePass(Request $request){

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $passwordUser = $user->password;
        $checkpass = Hash::check($request->oldpassword,$passwordUser);

        if($request->oldpassword != null && $request->password != null && $request->password_confirmation != null){
            if(!Hash::check($request->oldpassword,auth()->user()->password)){
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
