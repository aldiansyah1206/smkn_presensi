<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function createAdminLogin()
    {
        return view('auth.loginadmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|string'
        ]);

        $guard = $request->user_type;

        if (in_array($guard, ['pembina', 'siswa']) && Auth::guard($guard)->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            switch ($guard) {
                case 'pembina':
                    return redirect()->intended(RouteServiceProvider::PEMBINA_HOME);
                case 'siswa':
                    return redirect()->intended(RouteServiceProvider::SISWA_HOME);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function storeAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function destroy(Request $request)
    {
        $guard = $request->user_type ?? 'web'; // Default ke 'web' jika user_type tidak ada
    
        // Log out dari guard yang sesuai
        Auth::guard($guard)->logout();
    
        // Hapus sesi dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redirect ke halaman login yang sesuai
        if ($guard === 'web') {
            // Jika guard adalah 'web', kita anggap ini admin
            return redirect()->route('auth.loginadmin');
        } else {
            // Jika guard adalah selain 'web', anggap ini pembina atau siswa
            return redirect()->route('login');
        }
    }
    
    
}
