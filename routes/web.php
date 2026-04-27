<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController, 
    CompanyController, 
    PalletTypeController, 
    UserController, 
    ProductionController, 
    ShipmentController, 
    AccountantController
};

// 1. GİRİŞ VE ANA YÖNLENDİRME
Route::get('/', function () { return redirect()->route('login'); });

Route::middleware(['auth'])->group(function () {
    
    // TRAFİK POLİSİ: Giriş yapanı rolüne göre doğru sayfaya fırlatır
    Route::get('/home', [DashboardController::class, 'redirectByRole'])->name('home');

    // --- ADMIN PANELİ --- (Sadece Admin girebilir)
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/daily-production', [DashboardController::class, 'dailyProduction'])->name('daily-production');
        Route::get('/live-stock', function() { return view('live-stock'); })->name('live-stock');

        Route::resource('companies', CompanyController::class);
        Route::resource('pallet-types', PalletTypeController::class);
        Route::resource('users', UserController::class);
    });

    // --- MUHASEBE PANELİ ---
    Route::prefix('accountant')->group(function () {
        Route::get('/dashboard', [AccountantController::class, 'dashboard'])->name('accountant.dashboard');
        Route::get('/invoices', [AccountantController::class, 'invoices'])->name('accountant.invoices');
        Route::get('/returns', [AccountantController::class, 'returns'])->name('accountant.returns');
        Route::get('/stock', [AccountantController::class, 'stock'])->name('accountant.stock');
        
        Route::post('/update-invoice/{id}', [AccountantController::class, 'updateInvoice'])->name('accountant.updateInvoice');
        Route::delete('/return-delete/{id}', [AccountantController::class, 'destroyReturn'])->name('accountant.destroyReturn');
        Route::post('/add-stock', [AccountantController::class, 'addStock'])->name('accountant.addStock');
        Route::post('/logout', [AccountantController::class, 'logout'])->name('accountant.logout');
    });

    // --- ÜRETİM VE SEVKİYAT --- (Bunları admin middleware dışına aldık ki çakımcı ve sevkiyatçı girebilsin)
    Route::resource('production', ProductionController::class);
    Route::resource('shipment', ShipmentController::class);
});
Route::get('/migrate-force', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate --force');
    return "Tablolar canavar gibi kuruldu!";
});



require __DIR__.'/auth.php';