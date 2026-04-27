<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Kullanıcı Ekle | Öztüre ERP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #6366f1; }
        .back-btn { color: #6366f1; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 600px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 25px; border: 1px solid #334155; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #94a3b8; font-size: 0.9rem; }
        input, select { width: 100%; padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: white; box-sizing: border-box; }
        .save-btn { background: #6366f1; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; width: 100%; }
        h2 { margin: 0; font-size: 1.3rem; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('users.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2>Yeni Kullanıcı Kaydı</h2>
</div>

<div class="container">
    <div class="card">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" name="name" required placeholder="Örn: mehmet_palet">
            </div>

            
            <div class="form-group">
                <label>Yetki (Rol)</label>
                <select name="role" required>
                    <option value="CAKIMCI">Çakımcı</option>
                    <option value="SEVKIYAT">Sevkiyatçı</option>
                    <option value="MUHASEBE">Muhasebe</option>
                    <option value="ADMIN">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="save-btn">Kullanıcıyı Kaydet</button>
        </form>
    </div>
</div>

</body>
</html>