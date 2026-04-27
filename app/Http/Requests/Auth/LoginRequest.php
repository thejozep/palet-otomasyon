<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt([
            'name' => $this->input('name'),
            'password' => $this->input('password'),
        ])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'name' => 'Kullanıcı adı veya şifre hatalı.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        request()->session()->regenerate();
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        throw ValidationException::withMessages([
            'name' => 'Çok fazla deneme yaptın, biraz bekle.',
        ]);
    }

    public function throttleKey(): string
    {
        return strtolower($this->input('name')).'|'.$this->ip();
    }
}