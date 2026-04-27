<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Company;
use App\Models\PalletType;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        
        // JS Filtreleme için paletleri firmaya göre grupla
        $palletTypesGrouped = PalletType::all()->groupBy('company_id');

        // Giriş yapan çakımcının bugünkü üretimleri
        $myProductions = Production::where('user_id', auth()->id())
            ->whereDate('created_at', today())
            ->with(['company', 'palletType'])
            ->latest()
            ->get();

        // Senin klasör yapına göre view ismini 'production' yaptık
        return view('production', compact('companies', 'palletTypesGrouped', 'myProductions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'pallet_type_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        Production::create([
            'user_id' => auth()->id(),
            'company_id' => $request->company_id,
            'pallet_type_id' => $request->pallet_type_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Üretim kaydedildi.');
    }

    public function destroy($id)
    {
        $production = Production::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $production->delete();

        return redirect()->back()->with('success', 'Üretim kaydı silindi.');
    }
}