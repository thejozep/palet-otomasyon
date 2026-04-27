<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalletType extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'code', 'description'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    } // <-- BU PARANTEZ EKSİKTİ VEYA YANLIŞ YERDEYDİ

    public function productions()
    {
        return $this->hasMany(Production::class, 'pallet_type_id');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'pallet_type_id');
    }
}