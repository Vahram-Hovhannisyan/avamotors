<?php

namespace App\Models;

use App\Mail\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'address', 'city', 'locale'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];

    // ── Role helpers ──────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    // ── Relations ─────────────────────────────────────

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // ── Email verification ────────────────────────────

    public function sendEmailVerificationNotification(): void
    {
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($this->email)]
        );

        Mail::to($this->email)->send(
            new VerifyEmail($verifyUrl, $this->name)
        );
    }

    public function pricingTiers(): BelongsToMany
    {
        return $this->belongsToMany(PricingTier::class, 'pricing_tier_user')
            ->withTimestamps();
    }

// Метод для получения активного pricing tier пользователя
    public function getActivePricingTier()
    {
        return $this->pricingTiers()
            ->where('is_active', true)
            ->first();
    }

}
