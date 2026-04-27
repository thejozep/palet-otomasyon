<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stoklar - Öztüre Palet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f7f6; margin: 0; }
        /* ÜST MENÜ */
        .navbar { background: #1e293b; color: white; padding: 0 5%; display: flex; justify-content: space-between; align-items: center; height: 65px; position: sticky; top: 0; z-index: 1000; }
        .nav-links { display: flex; gap: 20px; }
        .nav-links a { color: #cbd5e1; text-decoration: none; font-size: 14px; font-weight: 500; transition: 0.3s; }
        .nav-links a:hover { color: #3b82f6; }
        .btn-logout { background: #ef4444; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        
        .container { padding: 30px 5%; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #f1f5f9; }
        th { background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase; }
        
        .badge { padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 13px; }
        .badge-plus { background: #dcfce7; color: #166534; }
        .badge-minus { background: #fee2e2; color: #991b1b; }
        .info-note { color: #64748b; font-size: 12px; font-style: italic; margin-top: 20px; display: block; }
    </style>
</head>
<body>

<nav class="navbar">
    <div style="font-weight: bold; font-size: 20px; color: #3b82f6;">ÖZTÜRE ERP</div>
    <div class="nav-links">
        <a href="/dashboard">🏠 Dashboard</a>
        <a href="/stoklar">📊 Stoklar</a>
        <a href="/companies">🏢 Firmalar</a>
        <a href="/pallet-types">📦 Paletler</a>
        <a href="/users">👥 Kullanıcılar</a>
        <a href="/invoice">🧾 Faturalar</a>
    </div>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Çıkış</button>
    </form>
</nav>

<div class="container">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px;">
            <h2 style="margin:0;"><i class="fa-solid fa-boxes-stacked"></i> Stoklar</h2>
            <span style="background: #e2e8f0; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; color: #475569;">
                Toplam {{ count($stocks) }} Kalem Ürün
            </span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Firma</th>
                    <th>Palet Tipi</th>
                    <th>Toplam Üretim</th>
                    <th>Toplam Sevkiyat</th>
                    <th>Güncel Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $s)
                    <tr>
                        <td><strong>{{ $s['company'] }}</strong></td>
                        <td>{{ $s['pallet_name'] }}</td>
                        <td style="color: #10b981; font-weight: 500;">+{{ $s['produced'] }}</td>
                        <td style="color: #f43f5e; font-weight: 500;">-{{ $s['shipped'] }}</td>
                        <td>
                            <span class="badge {{ $s['stock'] < 0 ? 'badge-minus' : 'badge-plus' }}">
                                {{ $s['stock'] }} Adet {{ $s['stock'] < 0 ? '⚠️' : '' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                            <i class="fa-solid fa-inbox fa-2x"></i><br>Hareket gören stok bulunamadı.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <small class="info-note">* Bu sayfada 0 adetli değerler görünmemektedir.</small>
    </div>
</div>

</body>
</html>