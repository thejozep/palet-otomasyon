<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura Yönetimi | Öztüre ERP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .custom-shadow { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02); }
        .table-container { border-radius: 24px; overflow: hidden; background: white; border: 1px solid #f1f5f9; }
        tr:hover { background-color: #f8fafc; }
        .input-focus:focus { outline: none; border-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
    </style>
</head>
<body class="p-4 md:p-8">

    <div class="max-w-[1400px] mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <a href="{{ route('accountant.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-emerald-600 font-semibold transition-colors mb-2 text-sm">
                    <i class="fa-solid fa-arrow-left"></i> Panele Geri Dön
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Sevkiyat & Faturalandırma</h1>
            </div>
            
            <div class="flex items-center gap-3 bg-white p-3 rounded-2xl border border-slate-200 custom-shadow">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider leading-none">Güncel Tarih</p>
                    <p class="text-sm font-extrabold text-slate-700">{{ now()->format('d.m.Y') }}</p>
                </div>
            </div>
        </div>

        <div class="table-container custom-shadow">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Müşteri / Firma</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Ürün Detayı</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Miktar</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Lojistik</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Isıl İşlem</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Durum</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Fatura İşlemi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($pendingShipments as $shipment)
                        <tr>
                            <td class="px-6 py-5">
                                <span class="block font-bold text-slate-800">{{ $shipment->company->name ?? 'Belirsiz' }}</span>
                                <span class="text-xs text-slate-400 font-medium">{{ $shipment->created_at->format('d.m.Y H:i') }}</span>
                            </td>

                            <td class="px-6 py-5 font-semibold text-slate-600">
                                {{ $shipment->palletType->name ?? 'Belirsiz' }}
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold">
                                    {{ $shipment->quantity }} ADET
                                </span>
                            </td>

                            <td class="px-6 py-5 text-sm">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="fa-solid fa-truck text-slate-300 text-xs"></i>
                                    <span class="font-bold text-slate-700 uppercase">{{ $shipment->plate_number ?? '-' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-user-tag text-slate-300 text-xs"></i>
                                    <span class="text-slate-500 text-xs">{{ $shipment->driver_name ?? '-' }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                @if($shipment->heat_treatment_no)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-50 text-orange-700 rounded-lg text-[11px] font-extrabold border border-orange-100">
                                        {{ $shipment->heat_treatment_no }}
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs italic">Yok</span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                @if($shipment->invoice_no)
                                    <span class="text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full text-[11px] font-bold border border-emerald-100 italic">KESİLDİ</span>
                                @else
                                    <span class="text-amber-600 bg-amber-50 px-3 py-1 rounded-full text-[11px] font-bold border border-amber-100">BEKLİYOR</span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-right">
                                <form action="{{ route('accountant.updateInvoice', $shipment->id) }}" method="POST" class="flex items-center justify-end gap-2">
                                    @csrf
                                    <input type="text" name="invoice_no" 
                                           class="input-focus w-32 bg-slate-50 border border-slate-200 px-3 py-2 rounded-xl text-sm font-bold text-slate-700 transition-all" 
                                           value="{{ $shipment->invoice_no }}" 
                                           placeholder="Fatura No..." required>
                                    <button type="submit" class="bg-slate-900 hover:bg-emerald-600 text-white w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300">
                                        <i class="fa-solid {{ $shipment->invoice_no ? 'fa-rotate' : 'fa-check' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center text-slate-400">Henüz sevkiyat kaydı bulunamadı.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>