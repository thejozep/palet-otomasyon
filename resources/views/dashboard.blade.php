<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÖZTÜRE ERP | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #0f172a; margin: 0; color: white; }
        .header { background: #1e293b; padding: 20px 40px; text-align: center; border-bottom: 4px solid #3b82f6; }
        .container { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; padding: 40px; max-width: 1200px; margin: 0 auto; }
        .menu-card { background: #1e293b; padding: 30px; border-radius: 15px; text-align: center; text-decoration: none; color: white; transition: 0.3s; border: 1px solid #334155; }
        .menu-card:hover { background: #3b82f6; transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.3); }
        .menu-card i { font-size: 3rem; margin-bottom: 15px; display: block; }
        .menu-card span { font-size: 1.2rem; font-weight: bold; }
        .logout { background: #ef4444 !important; }
    </style>
</head>
<body>

<div class="header">
    <h1 style="margin:0;">ÖZTÜRE <span style="color: #3b82f6;">ERP</span> YÖNETİM</h1>
</div>

<div class="container">
    <a href="{{ route('daily-production') }}" class="menu-card">
        <i class="fa-solid fa-hammer text-blue-500"></i>
        <span>Günlük Üretim</span>
    </a>

    <a href="{{ route('live-stock') }}" class="menu-card">
        <i class="fa-solid fa-boxes-stacked"></i>
        <span>Stoklar</span>
    </a>

    <a href="{{ route('companies.index') }}" class="menu-card">
        <i class="fa-solid fa-city"></i>
        <span>Firmalar</span>
    </a>

    <a href="{{ route('pallet-types.index') }}" class="menu-card">
        <i class="fa-solid fa-box"></i>
        <span>Paletler</span>
    </a>

    <a href="{{ route('users.index') }}" class="menu-card">
        <i class="fa-solid fa-users-gear"></i>
        <span>Kullanıcılar</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" style="display: contents;">
        @csrf
        <button type="submit" class="menu-card logout" style="cursor: pointer; width: 100%; border: none;">
            <i class="fa-solid fa-power-off"></i>
            <span>Çıkış Yap</span>
        </button>
    </form>
</div>

</body>
</html>