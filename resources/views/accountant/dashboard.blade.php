<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muhasebe Yönetimi | Öztüre ERP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(circle at top right, #f1f5f9, #f8fafc);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 1);
        }
    </style>
</head>
<body class="antialiased">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/60 py-4 px-6 md:px-12 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-3">
            <div class="bg-emerald-600 p-2 rounded-lg">
                <i class="fa-solid fa-layer-group text-white text-xl"></i>
            </div>
            <div>
                <span class="text-xl font-extrabold text-slate-900 tracking-tight block leading-none">ÖZTÜRE ERP</span>
                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Muhasebe Departmanı</span>
            </div>
        </div>

        <form action="{{ route('accountant.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="group flex items-center gap-2 bg-slate-50 text-slate-600 hover:bg-red-50 hover:text-red-600 px-4 py-2.5 rounded-xl font-bold transition-all duration-300 border border-slate-200 hover:border-red-100 cursor-pointer">
                <span class="text-sm">Güvenli Çıkış</span>
                <i class="fa-solid fa-right-from-bracket group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12 md:py-20">
        <div class="max-w-2xl mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4 text-balance">
                Hoş geldin, <span class="text-emerald-600 uppercase">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-slate-500 text-lg font-medium leading-relaxed">
                İşletmenizin finansal akışını ve stok durumunu buradan yönetebilirsiniz. Lütfen yapmak istediğiniz işlemi seçin.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <a href="{{ route('accountant.invoices') }}" class="glass-card group p-8 rounded-[40px] shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 no-underline border-b-4 hover:border-blue-500">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3 text-left">Fatura Kayıt</h3>
                <p class="text-slate-500 text-sm leading-relaxed text-left font-medium">
                    Günlük sevkiyatları kontrol edin ve fatura girişlerini sisteme işleyin.
                </p>
                <div class="mt-8 flex items-center text-blue-600 font-bold text-sm gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    İşlem Yap <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a>

            <a href="{{ route('accountant.returns') }}" class="glass-card group p-8 rounded-[40px] shadow-sm hover:shadow-2xl hover:shadow-emerald-500/10 no-underline border-b-4 hover:border-emerald-500">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3 text-left">İade & Dış Alım</h3>
                <p class="text-slate-500 text-sm leading-relaxed text-left font-medium">
                    Müşteri iadelerini ve tedarikçi dış alımlarını stoklara dahil edin.
                </p>
                <div class="mt-8 flex items-center text-emerald-600 font-bold text-sm gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    İşlem Yap <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a>

            <a href="{{ route('accountant.stock') }}" class="glass-card group p-8 rounded-[40px] shadow-sm hover:shadow-2xl hover:shadow-orange-500/10 no-underline border-b-4 hover:border-orange-500">
                <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3 text-left">Canlı Stok</h3>
                <p class="text-slate-500 text-sm leading-relaxed text-left font-medium">
                    Depodaki güncel ürün miktarlarını ve varyasyonları anlık takip edin.
                </p>
                <div class="mt-8 flex items-center text-orange-600 font-bold text-sm gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Stokları Gör <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </a>

        </div>

        <footer class="mt-20 text-center border-t border-slate-200 pt-8">
            <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest">
                &copy; {{ date('Y') }} ÖZTÜRE PALET | Endüstriyel ERP Çözümleri
            </p>
        </footer>
    </main>

</body>
</html>