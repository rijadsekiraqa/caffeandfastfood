<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    use PermissionTrait;


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth')->except(['login']);
    }


    public function index()
    {
        $user = Auth::User();
        if ($this->hasPermissions('show_users', $user)) {
            $staffUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'staff');
            })->get();
            return view('Users/index', ['users' => $staffUsers]);
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($this->hasPermissions('create_user', $user)) {
            return view('users/create');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($this->hasPermissions('create_user', $user)) {
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


            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $user->assignRole([$role->name]);
                Session::flash('success', 'Perdoruesi u regjistrua me sukses me rolin: ' . $roleName);
            }
            return redirect('admin-dashboard/users');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::User();
        if ($this->hasPermissions('view_user', $user)) {
            $user = User::findOrFail($id);
            $roles = Role::all();
            return view('users/edit', compact('user', 'roles'));
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        if ($this->hasPermissions('view_user', $user)) {
            $user = User::findOrFail($id);
            $roles = Role::all();
            return view('users/edit', compact('user', 'roles'));
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if ($this->hasPermissions('update_user', $user)) {
            $user = User::findOrFail($id);

            $firstname = ucfirst($request->input('firstname'));
            $lastname = ucfirst($request->input('lastname'));
            $username = strtolower($request->input('username'));
            $email = $request->input('email');
            $password = $request->filled('password') ? bcrypt($request->input('password')) : $user->password;
            $roleName = $request->input('role');


            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->syncRoles([$roleName]);

            $user->save();


            Session::flash('success', 'Perdoruesi u perditesua me sukses');
            return redirect('admin-dashboard/users');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');


    }


    public function destroy(User $user)
    {
        $user = Auth::user();
        if ($this->hasPermissions('delete_user', $user)) {
            $user->delete();
            Session::flash('success', 'User deleted successfully');
            return redirect('admin-dashboard/users');
        }

        abort(403, 'Ju nuk keni akses ne kete dritare');


    }


    public function adminprofile()
    {
        $user = Auth::User();
        if ($this->hasPermissions('admin_profile', $user)) {
            return view('users/user-profile', compact('user'));
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');
    }

    public function updateAdminProfile(Request $request)
    {
        $user = Auth::user();
        if ($this->hasPermissions('admin_profile', $user)) {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:6'
            ]);


            $user->firstname = ucfirst($request->input('firstname'));
            $user->lastname = ucfirst($request->input('lastname'));
            $user->username = strtolower($request->input('username'));
            $user->email = $request->input('email');


            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->save();
            return redirect()->route('adminprofile');
        }
        abort(403, 'Ju nuk keni akses ne kete dritare');

    }


}
