<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Firmayı Düzenle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Create ile aynı, bütünlük bozulmasın */
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #fbbf24; }
        .back-btn { color: #fbbf24; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 600px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 25px; border: 1px solid #334155; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #94a3b8; font-size: 0.9rem; }
        input { width: 100%; padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: white; box-sizing: border-box; }
        .update-btn { background: #fbbf24; color: #000; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; }
        h2 { margin: 0; font-size: 1.3rem; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('companies.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Vazgeç</a>
    <h2>Firmayı Düzenle</h2>
</div>

<div class="container">
    <div class="card">
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="form-group">
                <label for="name">Firma Adı</label>
                <input type="text" name="name" id="name" value="{{ $company->name }}" required>
            </div>
            <button type="submit" class="update-btn"><i class="fa-solid fa-arrows-rotate"></i> Değişiklikleri Kaydet</button>
        </form>
    </div>
</div>

</body>
</html>