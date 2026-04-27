<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Yönetimi | Öztüre ERP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; margin: 0; }
        .nav { background: #1e293b; padding: 15px 40px; display: flex; align-items: center; gap: 20px; border-bottom: 3px solid #6366f1; }
        .back-btn { color: #6366f1; text-decoration: none; font-weight: bold; }
        .container { padding: 20px; max-width: 1200px; margin: auto; }
        .card { background: #1e293b; border-radius: 12px; padding: 20px; border: 1px solid #334155; }
        
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .add-btn { background: #6366f1; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .add-btn:hover { background: #4f46e5; }

        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; color: #94a3b8; border-bottom: 2px solid #334155; padding: 15px; font-size: 0.85rem; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid #334155; color: #f8fafc; }
        tr:hover { background: #111827; }

        /* Yetki Etiketleri (Badge) */
        .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; }
        .badge-admin { background: #ef4444; color: white; }
        .badge-cakimci { background: #f59e0b; color: white; }
        .badge-muhasebe { background: #3b82f6; color: white; }
        .badge-sevkiyat { background: #10b981; color: white; }

        .btn-delete { background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; transition: 0.2s; }
        .btn-delete:hover { background: #dc2626; }
        .active-session { color: #94a3b8; font-style: italic; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
    <h2 style="margin:0;"><i class="fa-solid fa-users-gear" style="color: #6366f1; margin-right: 10px;"></i> Kullanıcı Yönetimi</h2>
</div>

<div class="container">
    <div class="card">
        <div class="header-section">
            <h2 style="margin:0; font-size: 1.2rem;">Sistem Kullanıcıları</h2>
            <a href="{{ route('users.create') }}" class="add-btn">
                <i class="fa-solid fa-user-plus"></i> Yeni Kullanıcı
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kullanıcı Adı</th>
                    <th>Yetki Seviyesi</th>
                    <th style="text-align: right;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-circle-user text-gray-500"></i>
                            <strong>{{ $user->name }}</strong>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ strtolower($user->role) }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <i class="fa-solid fa-trash-can"></i> Sil
                                </button>
                            </form>
                        @else
                            <span class="active-session">Aktif Oturum</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>