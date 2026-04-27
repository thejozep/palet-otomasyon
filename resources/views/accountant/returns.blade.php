<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İade ve Stok Girişi | Öztüre ERP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #10b981; --bg: #f1f5f9; --dark: #1e293b; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); margin: 0; padding: 20px; color: var(--dark); }
        .container { max-width: 1100px; margin: auto; }
        .btn-back { text-decoration: none; color: #64748b; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .card { background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; margin-bottom: 25px; overflow: hidden; }
        .card-header { padding: 20px; background: #fff; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 10px; }
        .card-header h2 { margin: 0; font-size: 1.2rem; }
        .grid-form { display: grid; grid-template-columns: 2fr 2fr 1fr auto; gap: 15px; padding: 20px; background: #fafafa; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 0.8rem; font-weight: 700; color: #64748b; }
        .input-minimal { border: 1px solid #cbd5e1; padding: 10px; border-radius: 10px; outline: none; background: white; }
        .btn-add { background: var(--primary); color: white; border: none; padding: 12px 25px; border-radius: 10px; cursor: pointer; font-weight: 700; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; background: #f8fafc; color: #64748b; font-size: 0.75rem; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid #f1f5f9; }
        .badge-plus { background: #ecfdf5; color: #059669; padding: 5px 12px; border-radius: 8px; font-weight: 700; }
        .btn-delete { color: #ef4444; background: #fef2f2; border: none; padding: 8px; border-radius: 8px; cursor: pointer; transition: 0.2s; }
        .btn-delete:hover { background: #fee2e2; }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('accountant.dashboard') }}" class="btn-back">
        <i class="fa-solid fa-chevron-left"></i> Panosuna Dön
    </a>

    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-circle-plus" style="color: var(--primary);"></i> Yeni İade / Dış Alım Kaydı</h2>
        </div>
        <form action="{{ route('accountant.addStock') }}" method="POST" class="grid-form">
            @csrf
            <div class="form-group">
                <label>Firma</label>
                <select name="company_id" class="input-minimal" required>
                    @foreach($companies as $company) <option value="{{ $company->id }}">{{ $company->name }}</option> @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Palet Tipi</label>
                <select name="pallet_id" class="input-minimal" required>
                    @foreach($palletTypes as $type) <option value="{{ $type->id }}">{{ $type->name }}</option> @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Adet</label>
                <input type="number" name="qty" class="input-minimal" placeholder="0" min="1" required>
            </div>
            <button type="submit" class="btn-add">Stoğa Ekle</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-clock-rotate-left" style="color: #6366f1;"></i> Son Yapılan Girişler</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="padding-left: 20px;">Firma</th>
                    <th>Palet Tipi</th>
                    <th>Miktar</th>
                    <th style="text-align: right; padding-right: 20px;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentReturns as $return)
                <tr>
                    <td style="padding-left: 20px;"><strong>{{ $return->company->name ?? 'Belirsiz' }}</strong></td>
                    <td>{{ $return->palletType->name ?? 'Belirsiz' }}</td>
                    <td><span class="badge-plus">+{{ $return->quantity }} Adet</span></td>
                    <td style="text-align: right; padding-right: 20px;">
                        <form action="{{ route('accountant.destroyReturn', $return->id) }}" method="POST" onsubmit="return confirm('Bu kaydı sileceksiniz. Emin misiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" title="Sil">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:50px; color:#94a3b8;">
                        <i class="fa-solid fa-database" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                        Veritabanında kayıt bulunamadı.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>