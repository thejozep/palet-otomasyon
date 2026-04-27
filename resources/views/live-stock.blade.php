<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Canlı Stok Durumu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #3b82f6; }
        .back-btn { color: #3b82f6; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 1000px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 20px; border: 1px solid #334155; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; color: #94a3b8; border-bottom: 2px solid #334155; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #1e293b; }
        .stock-badge { background: #10b981; color: white; padding: 4px 12px; border-radius: 6px; font-weight: bold; }
        h2 { margin: 0; font-size: 1.5rem; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2>Canlı Stok Takibi</h2>
</div>

<div class="container">
    <div class="card">
        <h2><i class="fa-solid fa-boxes-stacked"></i> Mevcut Palet Stokları</h2>
        <table>
            <thead>
                <tr>
                    <th>Palet Tipi</th>
                    <th>Toplam Üretim</th>
                    <th>Toplam Sevkiyat</th>
                    <th>Kalan Stok</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Veritabanından verileri çekiyoruz (Daha sonra Controller'a taşıyabilirsin)
                    $stockData = DB::table('pallet_types')->get()->map(function($type) {
                        $produced = DB::table('productions')->where('pallet_type_id', $type->id)->sum('quantity');
                        $shipped = DB::table('shipments')->where('pallet_type_id', $type->id)->sum('quantity');
                        return (object)[
                            'name' => $type->name,
                            'produced' => $produced,
                            'shipped' => $shipped,
                            'total' => $produced - $shipped
                        ];
                    });
                @endphp

                @forelse($stockData as $data)
                <tr>
                    <td><strong>{{ $data->name }}</strong></td>
                    <td style="color: #60a5fa;">{{ $data->produced }}</td>
                    <td style="color: #f87171;">{{ $data->shipped }}</td>
                    <td><span class="stock-badge">{{ $data->total }} Adet</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; padding:20px;">Henüz stok verisi oluşmadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>