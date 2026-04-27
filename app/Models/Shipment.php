<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id', 
    'company_id', 
    'pallet_type_id', 
    'quantity', 
    'plate_number', 
    'driver_name', 
    'heat_treatment_no', 
    'invoice_no', 
    'status'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function palletType() { return $this->belongsTo(PalletType::class); }
}