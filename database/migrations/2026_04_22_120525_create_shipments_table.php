<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Sevkiyatçı kim?
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Hangi firmaya gidiyor?
            $table->foreignId('pallet_type_id')->constrained()->onDelete('cascade'); // Hangi palet gidiyor?
            $table->integer('quantity'); // Kaç adet sevk edildi?
            $table->string('plate_number')->nullable(); // Araç plakası (isteğe bağlı)
            $table->string('invoice_no')->nullable(); // Fatura/İrsaliye No (Muhasebe sonra dolduracak)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};