<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember') ? true : false;

        $check = $request->only('email', 'password');

        if(Auth::guard()->attempt($check, $remember_me)){
            if(auth()->user()->user_type_id == 1){
                return redirect('admin/dashboard');
            }
        }else{
            $user = User::where('email', request('email'))->first();
            if(!isset($user)){
                throw ValidationException::withMessages([
                    'email' => [trans('auth.failed')],
                ]);
            }elseif (!Hash::check(request('password'), $user->password)) {
                throw ValidationException::withMessages([
                    'password' => [trans('auth.password')],
                ]);
            }
            return redirect()->route('login');
        }
    }
}
