<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Üretim Kaydı | Öztüre Palet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; border-bottom: 3px solid #10b981; display: flex; align-items: center; gap: 20px; }
        .container { padding: 20px; max-width: 900px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 25px; border: 1px solid #334155; margin-bottom: 20px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr 120px; gap: 15px; }
        label { display: block; margin-bottom: 8px; color: #94a3b8; font-size: 0.85rem; }
        select, input { width: 100%; padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: white; font-size: 1rem; }
        .save-btn { background: #10b981; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; margin-top: 20px; transition: 0.3s; }
        .save-btn:hover { background: #059669; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; color: #94a3b8; border-bottom: 2px solid #334155; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #1e293b; }
        .qty-badge { background: #065f46; color: #34d399; padding: 4px 10px; border-radius: 6px; font-weight: bold; }
    </style>
</head>
<body>

<div class="nav">
    <h2 style="margin:0;"><i class="fa-solid fa-hammer" style="color: #10b981;"></i> Üretim Girişi</h2>

    <div style="margin-left: auto;">
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 15px; border-radius: 8px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-right-from-bracket"></i> Güvenli Çıkış
            </button>
        </form>
    </div>
</div>

<div class="container">
    <div class="card">
        <form action="{{ route('production.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div>
                    <label>Firma</label>
                    <select name="company_id" id="company_select" required>
                        <option value="">Firma Seçiniz...</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Palet Modeli</label>
                    <select name="pallet_type_id" id="pallet_select" required disabled>
                        <option value="">Önce Firma Seçin...</option>
                    </select>
                </div>
                <div>
                    <label>Adet</label>
                    <input type="number" name="quantity" min="1" required>
                </div>
            </div>
            <button type="submit" class="save-btn">ÜRETİMİ KAYDET</button>
        </form>
    </div>

    <div class="card">
        <h3 style="margin:0 0 15px 0; color:#94a3b8;">Bugün Çaktığın Paletler</h3>
        <table>
            <thead>
                <tr>
                    <th>Firma</th>
                    <th>Palet</th>
                    <th>Adet</th>
                    <th style="text-align:right;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myProductions as $prod)
                <tr>
                    <td>{{ $prod->company->name }}</td>
                    <td>{{ $prod->palletType->name }}</td>
                    <td><span class="qty-badge">{{ $prod->quantity }}</span></td>
                    <td style="text-align:right;">
                        <form action="{{ route('production.destroy', $prod->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#f87171; cursor:pointer;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#64748b;">Henüz kayıt girmediniz.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    const palletsGrouped = @json($palletTypesGrouped);

    document.getElementById('company_select').addEventListener('change', function() {
        const companyId = this.value;
        const palletSelect = document.getElementById('pallet_select');
        
        palletSelect.innerHTML = '<option value="">Palet Tipi Seçiniz...</option>';
        
        if(companyId && palletsGrouped[companyId]) {
            palletSelect.disabled = false;
            palletsGrouped[companyId].forEach(pallet => {
                const option = document.createElement('option');
                option.value = pallet.id;
                option.textContent = pallet.name;
                palletSelect.appendChild(option);
            });
        } else {
            palletSelect.disabled = true;
            palletSelect.innerHTML = '<option value="">Bu firmaya ait palet yok!</option>';
        }
    });
</script>

</body>
</html>