<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() { return view('dashboard'); }

    public function redirectByRole()
    {
        $user = auth()->user();
        
        if (!$user || !$user->role) {
            return redirect('/login');
        }

        $role = strtolower($user->role); 

        return match ($role) {
            'admin'      => redirect()->route('dashboard'),
            
            // Muhasebe Grubu
            'accountant', 
            'muhasebe'   => redirect()->route('accountant.dashboard'),
            
            // Sevkiyat Grubu
            'shipment', 
            'sevkiyat',
            'sevkiyatci' => redirect()->route('shipment.index'),
            
            // Üretim Grubu
            'production', 
            'cakimci'    => redirect()->route('production.index'),
            
            default      => redirect('/login'),
        };
    }

    public function dailyProduction()
    {
        // TR SAATİNE GÖRE BUGÜN
        $todayStart = Carbon::now('Europe/Istanbul')->startOfDay();

        $data = DB::table('productions')
            ->join('pallet_types', 'productions.pallet_type_id', '=', 'pallet_types.id')
            ->join('users', 'productions.user_id', '=', 'users.id')
            ->select(
                'users.name as worker_name', 
                'pallet_types.name as pallet_name', 
                'productions.quantity', 
                'productions.created_at',
                'users.role' // Rolü de çekelim ki kontrolde garanti olsun
            )
            ->where('productions.created_at', '>=', $todayStart)
            
            // --- MUHASEBECİYİ VE ADMİNİ LİSTEDEN ATAN FİLTRE ---
            // Sadece çakımcı/üretim elemanlarını gösteriyoruz
            ->whereIn(DB::raw('LOWER(users.role)'), ['cakimci', 'production'])
            
            ->orderBy('productions.created_at', 'desc')
            ->get();

        // Verileri işçiye göre grupla
        $workerData = $data->groupBy('worker_name');

        // Genel toplamları palet türüne göre hesapla
        $generalTotals = $data->groupBy('pallet_name')->map(function ($items, $name) {
            return (object) [
                'pallet_name' => $name,
                'total' => $items->sum('quantity')
            ];
        });

        return view('daily-production', compact('workerData', 'generalTotals'));
    }
}