<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory; // Notifiable kaldırıldı

    /**
     * Toplu atama yapılabilecek nitelikler.
     */
    protected $fillable = [
        'name',
        'password',
        'role',
    ];

    /**
     * Serileştirme sırasında gizlenecek nitelikler.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Niteliklerin cast edilmesi.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}