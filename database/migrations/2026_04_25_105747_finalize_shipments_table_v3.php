<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            if (!Schema::hasColumn('shipments', 'status')) {
                $table->string('status')->default('pending');
            }
            if (!Schema::hasColumn('shipments', 'plate_number')) {
                $table->string('plate_number')->nullable();
            }
            if (!Schema::hasColumn('shipments', 'driver_name')) {
                $table->string('driver_name')->nullable();
            }
            if (!Schema::hasColumn('shipments', 'heat_treatment_no')) {
                $table->string('heat_treatment_no')->nullable();
            }
        });
    }

    public function down(): void { }
};