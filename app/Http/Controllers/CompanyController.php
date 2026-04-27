<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        Company::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect('/companies');
    }
// ... mevcut kodların altına ekle ...

// 1. DÜZENLEME SAYFASINI AÇAN METOT
public function edit($id)
{
    $company = \App\Models\Company::findOrFail($id);
    return view('companies.edit', compact('company'));
}

// 2. FORMADAN GELEN VERİYİ KAYDEDEN METOT
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $company = \App\Models\Company::findOrFail($id);
    $company->update([
        'name' => $request->name
    ]);

    return redirect()->route('companies.index')->with('success', 'Firma bilgileri güncellendi.');
}

// 3. SİLME METODU (Eğer o da eksikse hata verir, hazır gelmişken ekle)
public function destroy($id)
{
    $company = \App\Models\Company::findOrFail($id);
    $company->delete();

    return redirect()->route('companies.index')->with('success', 'Firma silindi.');
   }
}