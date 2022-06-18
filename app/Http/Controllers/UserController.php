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
        $user = auth()->user();
        $emailUser = $user->email;
        $nameUser = $user->name;
        $alamatUser = $user->alamat;
        $no_telpUser = $user->no_telp;

        if($request->name != null){
            $request->validate([
                'name' => 'required'
            ]);
            $nameUser = $request->name;
        }
        if($request->email != null){
            $request->validate([
                'email' => 'required|email|unique:users,email'
            ]);
            $emailUser = $request->email;
        }

        if($request->alamat != null){
            $request->validate([
                'alamat' => 'required'
            ]);
            $alamatUser = $request->alamat;
        }
        if($request->no_telp != null){
            $request->validate([
                'no_telp' => 'required|numeric'
            ]);
            $no_telpUser = $request->no_telp;
            
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
