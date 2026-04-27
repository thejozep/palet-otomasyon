<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Firma Ekle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #3b82f6; }
        .back-btn { color: #3b82f6; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 600px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 25px; border: 1px solid #334155; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #94a3b8; font-size: 0.9rem; }
        input { width: 100%; padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: white; box-sizing: border-box; }
        input:focus { border-color: #3b82f6; outline: none; }
        .save-btn { background: #3b82f6; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; transition: 0.3s; }
        .save-btn:hover { background: #2563eb; }
        h2 { margin: 0; font-size: 1.3rem; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('companies.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2>Yeni Firma Kaydı</h2>
</div>

<div class="container">
    <div class="card">
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Firma Adı</label>
                <input type="text" name="name" id="name" placeholder="Örn: Şişecam" required autofocus>
            </div>
            <button type="submit" class="save-btn"><i class="fa-solid fa-floppy-disk"></i> Firmayı Kaydet</button>
        </form>
    </div>
</div>

</body>
</html>