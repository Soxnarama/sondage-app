<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        Log::info('Tentative d\'authentification avec:', [
            'login' => $this->login,
            'using_mail' => true
        ]);

        // Tenter l'authentification avec le mail
        if (!Auth::attempt(['mail' => $this->login, 'password' => $this->password], $this->boolean('remember'))) {
            Log::info('Échec authentification par mail, tentative avec username');

            // Si l'authentification par mail échoue, essayer avec le nom d'utilisateur
            if (!Auth::attempt(['username' => $this->login, 'password' => $this->password], $this->boolean('remember'))) {
                Log::error('Échec authentification par username');
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'login' => trans('auth.failed'),
                ]);
            }
        }

        Log::info('Authentification réussie pour:', ['user' => Auth::user()->mail ?? Auth::user()->username]);
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('login')).'|'.$this->ip());
    }
}
