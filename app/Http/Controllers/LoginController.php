<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // 🔥 INI YANG PENTING

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi akun berhasil! Silahkan login.');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/');
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
