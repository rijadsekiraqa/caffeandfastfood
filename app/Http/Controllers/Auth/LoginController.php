<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function showLoginForm()
    {
        // Customize this method to return your custom login view
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Explicitly define $credentials
        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/admin-dashboard'); // Customize the redirect path after successful login
        }

        // If authentication fails, redirect back to the login form with an error message
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }



}
