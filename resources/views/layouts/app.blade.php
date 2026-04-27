<nav class="bg-slate-900 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-8">
                <div class="flex-shrink-0 font-bold text-xl tracking-wider text-blue-400">
                    FABRİKA ERP
                </div>
                <div class="hidden md:flex items-baseline space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-700">Dashboard</a>
                    <a href="{{ route('admin.live-stock') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-700">Stoklar</a>
                    <a href="{{ route('companies.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-700">Firmalar</a>
                    <a href="{{ route('pallet-types.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-700">Paletler</a>
                    <a href="{{ route('users.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-700">Kullanıcılar</a>
                    <a href="{{ route('accountant.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-slate-700">Fatura Bekleyenler</a>
                </div>
            </div>
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-right-from-bracket"></i> Güvenli Çıkış
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>