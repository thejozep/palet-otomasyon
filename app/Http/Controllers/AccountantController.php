<?php

namespace App\Http\Controllers;

use App\Models\{Shipment, Company, PalletType, Production};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountantController extends Controller
{
    public function dashboard() 
    { 
        return view('accountant.dashboard');
    }

    public function invoices()
    {
        $pendingShipments = Shipment::with(['company', 'palletType'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('accountant.invoices', compact('pendingShipments'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function returns()
    {
        $companies = Company::all();
        $palletTypes = PalletType::all();
        
        // Buradaki note filtresi artık Model'e eklediğimiz için çalışacak
        $recentReturns = Production::with(['company', 'palletType'])
            ->where('note', 'Muhasebe Girişi')
            ->latest()
            ->take(50)
            ->get();
            
        return view('accountant.returns', compact('companies', 'palletTypes', 'recentReturns'));
    }

    public function stock()
    {
        $stocks = PalletType::withSum('productions', 'quantity')
            ->withSum('shipments', 'quantity')
            ->get();
        return view('accountant.stock', compact('stocks'));
    }

    public function updateInvoice(Request $request, $id)
    {
        $request->validate([
            'invoice_no' => 'required|string|max:255',
        ]);

        $shipment = Shipment::findOrFail($id);
        
        $shipment->update([
            'invoice_no' => $request->invoice_no,
            'status' => 'completed'
        ]);

        return redirect()->back()->with('success', 'Fatura numarası başarıyla kaydedildi.');
    }

    public function addStock(Request $request)
    {
        $request->validate([
            'company_id' => 'required', 
            'pallet_id' => 'required', 
            'qty' => 'required|integer|min:1'
        ]);
        
        Production::create([
            'user_id' => auth()->id(), 
            'company_id' => $request->company_id,
            'pallet_type_id' => $request->pallet_id, 
            'quantity' => $request->qty,
            'note' => 'Muhasebe Girişi', // Modeldeki fillable sayesinde artık kaydedilecek
        ]);
        
        return redirect()->back()->with('success', 'Kayıt başarılı.');
    }

    public function destroyReturn($id)
    {
        Production::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Silindi.');
    }
}