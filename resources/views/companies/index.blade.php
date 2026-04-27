<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Firmalar | Yönetim Paneli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #3b82f6; }
        .back-btn { color: #3b82f6; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 1200px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 20px; border: 1px solid #334155; }
        
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .add-btn { background: #3b82f6; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .add-btn:hover { background: #2563eb; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; color: #94a3b8; border-bottom: 2px solid #334155; padding: 12px; font-size: 0.9rem; }
        td { padding: 12px; border-bottom: 1px solid #1e293b; color: #f8fafc; }
        tr:hover { background: #111827; }

        .btn-edit { color: #fbbf24; text-decoration: none; margin-right: 15px; font-size: 1.1rem; transition: 0.2s; }
        .btn-edit:hover { color: #f59e0b; }
        
        .btn-delete { background: none; border: none; color: #f87171; cursor: pointer; font-size: 1.1rem; transition: 0.2s; padding: 0; }
        .btn-delete:hover { color: #ef4444; }

        h2 { margin: 0; font-size: 1.3rem; color: #f8fafc; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2><i class="fa-solid fa-city" style="color: #3b82f6; margin-right: 10px;"></i> Firma Yönetim Merkezi</h2>
</div>

<div class="container">
    <div class="card">
        <div class="header-section">
            <h2>Kayıtlı Firmalar</h2>
            <a href="{{ route('companies.create') }}" class="add-btn">
                <i class="fa-solid fa-plus"></i> Yeni Firma Ekle
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Firma Adı</th>
                    <th>Kayıt Tarihi</th>
                    <th style="text-align: right;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                <tr>
                    <td><strong>{{ $company->name }}</strong></td>
                    <td style="color: #94a3b8;">{{ \Carbon\Carbon::parse($company->created_at)->format('d.m.Y H:i') }}</td>
                    <td style="text-align: right;">
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn-edit" title="Düzenle">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bu firmayı silerseniz buna bağlı eski kayıtlar etkilenebilir. Emin misiniz?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Sil">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 40px; color: #94a3b8;">Sisteme kayıtlı firma bulunamadı.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>