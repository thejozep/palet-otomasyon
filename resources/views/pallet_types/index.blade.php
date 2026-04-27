<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Palet Tipleri | Yönetim</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #3b82f6; }
        .back-btn { color: #3b82f6; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 1200px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 20px; border: 1px solid #334155; }
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .add-btn { background: #3b82f6; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; color: #94a3b8; border-bottom: 2px solid #334155; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #1e293b; }
        .btn-edit { color: #fbbf24; margin-right: 15px; }
        .btn-delete { background: none; border: none; color: #f87171; cursor: pointer; }
        h2 { margin: 0; font-size: 1.3rem; }
    </style>
</head>
<body>
<div class="nav">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2><i class="fa-solid fa-box" style="color: #3b82f6; margin-right: 10px;"></i> Palet Tipleri</h2>
</div>
<div class="container">
    <div class="card">
        <div class="header-section">
            <h2>Kayıtlı Modeller</h2>
            <a href="{{ route('pallet-types.create') }}" class="add-btn">+ Yeni Palet Tipi</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Palet Adı / Modeli</th>
                    <th style="text-align: right;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($palletTypes as $type)
                <tr>
                    <td><strong>{{ $type->name }}</strong></td>
                    <td style="text-align: right;">
                        <a href="{{ route('pallet-types.edit', $type->id) }}" class="btn-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('pallet-types.destroy', $type->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Silinsin mi?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>