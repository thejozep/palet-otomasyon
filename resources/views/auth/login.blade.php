<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap | FABRİKA ERP</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #1e293b;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo {
            font-size: 28px;
            font-weight: 800;
            color: #3b82f6;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }
        .welcome-text {
            color: #64748b;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }
        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 16px;
            transition: all 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .btn-login {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn-login:hover {
            background: #2563eb;
        }
        .error-message {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .footer-text {
            margin-top: 25px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="logo">FABRİKA ERP</div>
    <div class="welcome-text">Üretim ve Stok Yönetim Paneline Hoş Geldiniz</div>

    @if ($errors->any())
        <div class="error-message">
            Kullanıcı adı veya şifre hatalı!
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Kullanıcı Adı</label>
            <input type="text" name="name" id="name" placeholder="Kullanıcı adınızı girin" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Şifre</label>
            <input type="password" name="password" id="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-login">Sisteme Giriş Yap</button>
    </form>

    <div class="footer-text">
        &copy; 2026 Fabrika Takip Sistemi | Tüm Hakları Saklıdır.
    </div>
</div>

</body>
</html>