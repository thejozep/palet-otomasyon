<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Günlük Üretim Dağılımı</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #3b82f6; }
        .back-btn { color: #3b82f6; text-decoration: none; font-weight: bold; }
        .container { display: grid; grid-template-columns: 3fr 1fr; gap: 20px; padding: 20px; }
        .card { background: #1e293b; border-radius: 12px; padding: 15px; border: 1px solid #334155; }
        .worker-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 15px; }
        .worker-box { background: #111827; border: 1px solid #3b82f6; border-radius: 8px; padding: 10px; }
        .worker-header { font-size: 1rem; font-weight: bold; color: #3b82f6; border-bottom: 1px solid #334155; padding-bottom: 5px; margin-bottom: 8px; display: flex; justify-content: space-between; }
        .data-table { width: 100%; font-size: 0.85rem; border-collapse: collapse; }
        .data-table td { padding: 4px 0; border-bottom: 1px solid #1f2937; }
        .time-text { color: #94a3b8; font-size: 0.75rem; text-align: right; }
        .qty-text { color: #10b981; font-weight: bold; text-align: center; width: 40px; }
        .total-badge { background: #10b981; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; }
        h2 { margin-top: 0; color: #f8fafc; font-size: 1.2rem; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2 style="margin:0;">Canlı Çakım Takip Otomasyonu</h2>
</div>

<div class="container">
    <div class="card">
        <h2><i class="fa-solid fa-hammer"></i> Personel Bazlı Üretim</h2>
        <div class="worker-grid">
            @forelse($workerData as $worker => $items)
                <div class="worker-box">
                    <div class="worker-header">
                        <span>{{ strtoupper($worker) }}</span>
                        <span class="total-badge">{{ $items->sum('quantity') }}</span>
                    </div>
                    <table class="data-table">
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->pallet_name }}</td>
                                <td class="qty-text">{{ $item->quantity }}</td>
                                <td class="time-text">
                                    <i class="fa-regular fa-clock"></i> 
                                    {{ \Carbon\Carbon::parse($item->created_at)->timezone('Europe/Istanbul')->format('H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @empty
                <p>Bugün henüz üretim kaydı girilmedi.</p>
            @endforelse
        </div>
    </div>

    <div class="card" style="height: fit-content;">
        <h2><i class="fa-solid fa-chart-pie"></i> Model Toplamları</h2>
        @foreach($generalTotals as $total)
            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #334155;">
                <span style="font-size: 0.9rem;">{{ $total->pallet_name }}</span>
                <span style="color: #10b981; font-weight: bold; font-size: 1.1rem;">{{ $total->total }}</span>
            </div>
        @endforeach
        
        @if($generalTotals->isEmpty())
            <p>Veri bulunamadı.</p>
        @endif
    </div>
</div>

</body>
</html>