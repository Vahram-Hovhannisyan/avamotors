<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'brand',
        'description',
        'price',
        'quantity',
        'image',
        'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // ── Relations ─────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carModels(): BelongsToMany
    {
        return $this->belongsToMany(CarModel::class, 'product_car_model');
    }

    // Аналоги артикулов других производителей
    public function analogs(): BelongsToMany
    {
        return $this->belongsToMany(Analog::class, 'product_analog')
            ->orderBy('brand')
            ->orderBy('sku');
    }

    // Товары для которых этот товар является аналогом
    public function analogOf(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_analogs',
            'analog_id',
            'product_id'
        );
    }

    // ── Helpers ───────────────────────────────────────

    public function inStock(): bool
    {
        return $this->quantity > 0;
    }

    public function formattedPrice(): string
    {
        return number_format($this->price, 0, '.', ' ') . ' դր.';
    }

    // ── Pricing Tier Methods ──────────────────────────

    /**
     * Get final price for specific user considering their pricing tier
     */
    public function getPriceForUser(?User $user): float
    {
        if (!$user) {
            return $this->price;
        }

        $pricingTier = $user->getActivePricingTier();

        if (!$pricingTier) {
            return $this->price;
        }

        $finalPrice = $pricingTier->applyPrice($this->price);

        // Don't allow negative price
        return max(0, $finalPrice);
    }

    /**
     * Get formatted price for user
     */
    public function getFormattedPriceForUser(?User $user): string
    {
        return number_format($this->getPriceForUser($user), 0, '.', ' ') . ' դր.';
    }

    /**
     * Check if product has special price for user
     */
    public function hasSpecialPriceForUser(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        $pricingTier = $user->getActivePricingTier();

        return $pricingTier && $pricingTier->applyPrice($this->price) != $this->price;
    }

    /**
     * Get discount information for user
     */
    public function getDiscountForUser(?User $user): ?array
    {
        if (!$user) {
            return null;
        }

        $pricingTier = $user->getActivePricingTier();

        if (!$pricingTier) {
            return null;
        }

        $originalPrice = $this->price;
        $finalPrice = $pricingTier->applyPrice($originalPrice);

        if ($finalPrice >= $originalPrice) {
            return null;
        }

        $discountAmount = $originalPrice - $finalPrice;
        $discountPercent = round(($discountAmount / $originalPrice) * 100);

        return [
            'amount' => $discountAmount,
            'percent' => $discountPercent,
            'type' => $pricingTier->type,
            'tier_name' => $pricingTier->name,
            'formatted_amount' => number_format($discountAmount, 0) . ' դր.',
            'formatted_percent' => $discountPercent . '%',
        ];
    }
}
