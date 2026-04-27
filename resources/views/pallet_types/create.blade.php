<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Palet Tipi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #3b82f6; }
        .back-btn { color: #3b82f6; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 600px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 25px; border: 1px solid #334155; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #94a3b8; font-size: 0.9rem; }
        input, select, textarea { width: 100%; padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: white; box-sizing: border-box; }
        input:focus, select:focus { border-color: #3b82f6; outline: none; }
        .save-btn { background: #3b82f6; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; }
        h2 { margin: 0; font-size: 1.3rem; }
    </style>
</head>
<body>
<div class="nav">
    <a href="{{ route('pallet-types.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2>Yeni Palet Modeli Tanımla</h2>
</div>
<div class="container">
    <div class="card">
        <form action="{{ route('pallet-types.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Ait Olduğu Firma</label>
                <select name="company_id" required>
                    <option value="">Firma Seçiniz...</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Palet Adı</label>
                <input type="text" name="name" placeholder="Örn: 80x120 Euro" required>
            </div>
            <div class="form-group">
                <label>Palet Kodu (Opsiyonel)</label>
                <input type="text" name="code" placeholder="Örn: EUR-01">
            </div>
            <button type="submit" class="save-btn">Modeli Sisteme Kaydet</button>
        </form>
    </div>
</div>
</body>
</html>