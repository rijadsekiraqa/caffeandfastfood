<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


//    public function __construct()
//    {
//        $this->middleware('auth'); // Sigurohuni që middleware 'auth' të aplikohet së pari
//        $this->middleware('role:admin');
//        $this->middleware('role:staff')->only('adminprofile');
//    }






    public function index()
    {
//        if (Auth::check()) {
//            // Get the authenticated user's roles
//            $userRoles = Auth::user()->getRoleNames()->toArray();
//
//            // Now $userRoles contains an array of role names associated with the authenticated user
//            dd($userRoles);
//        } else {
//            // Handle the case when the user is not authenticated
//            // You can redirect them to the login page or perform any other action
//        }
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'staff');
        })->get();

        return view('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'

        ]);

        $firstname = ucfirst($request->input('firstname'));
        $lastname = ucfirst($request->input('lastname'));
        $username = strtolower($request->input('username'));
        $email = $request->input('email');
        $password = $request->input('password');
        $roleName = $request->input('role');

        // Create the user
        $user = User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        // Attach the role to the user
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $user->assignRole([$role->name]);
            Session::flash('success', 'User registered successfully with role: ' . $roleName);
        } else {
            Session::flash('error', 'Role not found');
        }

        return redirect('/users');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Assuming you have a Role model

        return view('users/edit', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Assuming you have a Role model

        return view('users/edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $firstname = ucfirst($request->input('firstname'));
        $lastname = ucfirst($request->input('lastname'));
        $username = strtolower($request->input('username'));
        $email = $request->input('email');
        // Check if a new password is provided
        $password = $request->filled('password') ? bcrypt($request->input('password')) : $user->password;
        $roleName = $request->input('role');


        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->syncRoles([$roleName]);

        $user->save();



        Session::flash('success', 'User updated successfully');
        return redirect('users');
    }



    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('success', 'User deleted successfully');
        return redirect('users');
    }


    public function adminprofile()
    {
        $user = Auth::user();
        return view('users/user-profile', compact('user'));
    }

    public function updateAdminProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6'
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Update user data based on the form input
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        // Check if a new password is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }


        $user->save();

        // Redirect back or return a response as needed
        return redirect()->route('adminprofile')->with('success', 'Profile updated successfully');
    }




}
