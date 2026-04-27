<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Canlı Stok Durumu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #f8fafc; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 15px; border: 1px solid #e2e8f0; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #f59e0b; text-decoration: none; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 15px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <a href="{{ route('accountant.dashboard') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <div class="card">
        <h2>Fabrika Canlı Stok Durumu</h2>
        <table>
            <thead>
                <tr>
                    <th>Palet Tipi</th>
                    <th>Toplam Üretim (+İade)</th>
                    <th>Toplam Sevkiyat</th>
                    <th>Kalan Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <td><b>{{ $stock->name }}</b></td>
                    <td style="color:green;">+{{ $stock->productions_sum_quantity ?? 0 }}</td>
                    <td style="color:red;">-{{ $stock->shipments_sum_quantity ?? 0 }}</td>
                    <td><b style="font-size:1.2rem;">{{ ($stock->productions_sum_quantity ?? 0) - ($stock->shipments_sum_quantity ?? 0) }}</b></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>