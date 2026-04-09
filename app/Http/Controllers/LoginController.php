<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'slug' => 'required|unique:users',
            'email' => 'required|email|unique:users|email:dns',
            'username' => 'required|string|min:3|max:255|unique:users',
            'password' => 'required|string|min:5',
            'role' => 'required'
        ]);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi akun berhasil! Silahkan login.');
        // return dd($request->all());
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:5'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role;

            switch ($role) {
                case 'admin':
                    return redirect()->intended('/dashboard');
                case 'user':
                    return redirect()->intended('/');
                
                default:
                    Auth::logout();
                    return back()->with('error', 'Role tidak dikenali.');
            }

            
        }

        return back()->with('error', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
