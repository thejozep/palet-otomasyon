<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'pallet_type_id',
        'quantity',
        'note' // BU EKSİKTİ, EKLEDİM
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function palletType()
    {
        return $this->belongsTo(PalletType::class, 'pallet_type_id');
    }
}