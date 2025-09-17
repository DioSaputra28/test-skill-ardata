<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()
    {
        return view('admins.auth.login');
    }



    public function register(Request $request)
    {
        return view('admins.auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'User berhasil dibuat.');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);


        $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $request->session()->put('user_id', Auth::user()->user_id);
            $request->session()->put('user_name', Auth::user()->name);
            $request->session()->put('user_email', Auth::user()->email);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->forget(['user_id', 'user_name', 'user_email']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
