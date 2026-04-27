<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Production;
use App\Models\Company;
use App\Models\PalletType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $palletTypes = PalletType::all(); // Tüm paletleri düz liste al
        $palletTypesGrouped = PalletType::all()->groupBy('company_id');

        // Canlı Stok Durumu
        $productions = Production::select('pallet_type_id', DB::raw('SUM(quantity) as total'))->groupBy('pallet_type_id')->pluck('total', 'pallet_type_id');
        $shipments = Shipment::select('pallet_type_id', DB::raw('SUM(quantity) as total'))->groupBy('pallet_type_id')->pluck('total', 'pallet_type_id');

        $stocks = [];
        foreach ($palletTypes as $type) {
            $produced = $productions[$type->id] ?? 0;
            $shipped = $shipments[$type->id] ?? 0;
            $stocks[$type->id] = $produced - $shipped;
        }

        $myShipments = Shipment::where('user_id', auth()->id())
            ->whereDate('created_at', today())
            ->with(['company', 'palletType'])
            ->latest()
            ->get();

        return view('shipment.index', compact('companies', 'palletTypes', 'palletTypesGrouped', 'myShipments', 'stocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'plate_number' => 'required|string',
            'driver_name' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.pallet_type_id' => 'required',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->items as $item) {
                    Shipment::create([
                        'user_id' => auth()->id(),
                        'company_id' => $request->company_id,
                        'pallet_type_id' => $item['pallet_type_id'],
                        'quantity' => $item['quantity'],
                        'plate_number' => $request->plate_number,
                        'driver_name' => $request->driver_name,
                        'heat_treatment_no' => $item['heat_treatment_no'] ?? null,
                    ]);
                }
            });

            return redirect()->route('shipment.index')->with('success', 'Sevkiyat kalemleri başarıyla kaydedildi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hata oluştu: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $shipment = Shipment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $shipment->delete();
        return redirect()->back()->with('success', 'Sevkiyat kaydı silindi.');
    }
}