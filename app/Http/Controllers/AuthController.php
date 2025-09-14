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
