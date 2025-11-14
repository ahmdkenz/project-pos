<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use LogsActivity;
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember')) ) {
            $request->session()->regenerate();

            // Log login activity
            $this->logLogin(Auth::user()->name);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            // Log logout activity SEBELUM logout (agar user masih authenticated)
            $this->logLogout(Auth::user()->name);
            
            // Logout user
            Auth::logout();
        }
        
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
