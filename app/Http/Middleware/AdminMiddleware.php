<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Giriş yapmamışsa login'e şutla
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $userRole = strtolower($user->role);
        $path = $request->path();

        // 2. Rota bazlı Yetki Kontrolü
        // Admin her yere girebilir, o yüzden ona dokunmuyoruz.
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Muhasebeci sadece invoice (fatura) işlerine bakabilir
        if ($userRole === 'muhasebe' && !str_contains($path, 'invoice') && !str_contains($path, 'accountant')) {
            return redirect('/invoice');
        }

        // Sevkiyatçı sadece shipment işlerine bakabilir
        if ($userRole === 'sevkiyat' && !str_contains($path, 'shipment')) {
            return redirect('/shipment');
        }

        // Çakımcı sadece production işlerine bakabilir
        if ($userRole === 'cakimci' && !str_contains($path, 'production')) {
            return redirect('/production');
        }

        return $next($request);
    }
}