<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{


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

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required',
            'password' => 'required',
        ]);

        $identity = $request->input('identity');
        $password = $request->input('password');

        $loginField = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $identity,
            'password' => $password,
        ];

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/admin-dashboard');
        }

        return redirect()->back()->withInput($request->only('identity', 'remember'))->withErrors([
            'login' => 'Email apo Fjalekalimi eshte gabim',
        ]);
    }


}
