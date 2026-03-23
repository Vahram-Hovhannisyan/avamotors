<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PricingTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'value',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Связь с пользователями
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pricing_tier_user')
            ->withTimestamps();
    }

    // Метод для применения цены
    public function applyPrice(float $originalPrice): float
    {
        if ($this->type === 'percentage') {
            // Процентная скидка/наценка (например: 10% = 0.9)
            return $originalPrice * (1 - ($this->value / 100));
        } else {
            // Фиксированная скидка/наценка
            return $originalPrice - $this->value;
        }
    }

    // Scope для активных tiers
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
