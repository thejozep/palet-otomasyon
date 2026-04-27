<?php

namespace App\Http\Controllers;

use App\Models\PalletType;
use App\Models\Company;
use Illuminate\Http\Request;

class PalletTypeController extends Controller
{
    // LİSTELEME
    public function index()
    {
        $palletTypes = PalletType::with('company')->get();
        return view('pallet_types.index', compact('palletTypes'));
    }

    // YENİ KAYIT SAYFASI
    public function create()
    {
        $companies = Company::all();
        return view('pallet_types.create', compact('companies'));
    }

    // KAYDETME
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        PalletType::create([
            'company_id'  => $request->company_id,
            'name'        => $request->name,
            'code'        => $request->code,
            'description' => $request->description,
        ]);

        return redirect()->route('pallet-types.index')->with('success', 'Palet başarıyla eklendi.');
    }

    // DÜZENLEME SAYFASI
    public function edit($id)
    {
        $pallet_type = PalletType::findOrFail($id);
        $companies = Company::all();
        return view('pallet_types.edit', compact('pallet_type', 'companies'));
    }

    // GÜNCELLEME
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        $pallet_type = PalletType::findOrFail($id);
        $pallet_type->update([
            'name'        => $request->name,
            'company_id'  => $request->company_id,
            'code'        => $request->code,
            'description' => $request->description,
        ]);

        return redirect()->route('pallet-types.index')->with('success', 'Palet tipi güncellendi.');
    }

    // SİLME
    public function destroy($id)
    {
        $pallet_type = PalletType::findOrFail($id);
        $pallet_type->delete();
        return redirect()->route('pallet-types.index')->with('success', 'Palet tipi silindi.');
    }
}