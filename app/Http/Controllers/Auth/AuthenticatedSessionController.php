<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Sadece name ve password doğruluyoruz
        $credentials = $request->validate([
            'name'     => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Burası kritik: Herkesi tek kapıdan (home) sokuyoruz
            // Home rotası DashboardController@redirectByRole'a bağlı olduğu için
            // oradaki match yapısı devreye girecek.
            return redirect()->route('home');
        }

        return back()->withErrors([
            'name' => 'Kullanıcı adı veya şifre hatalı.',
        ])->onlyInput('name');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}