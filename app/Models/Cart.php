<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'items'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get items collection
     */
    public function getItemsAttribute($value)
    {
        $items = json_decode($value, true) ?? [];

        // Загружаем модели продуктов
        foreach ($items as &$item) {
            if (isset($item['product_id'])) {
                $item['product'] = Product::find($item['product_id']);
            }
        }

        return $items;
    }

    /**
     * Calculate cart total
     */
    public function getTotalAttribute(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            if (isset($item['product'])) {
                $total += $item['product']->price * $item['quantity'];
            }
        }
        return $total;
    }

    /**
     * Get cart count
     */
    public function getCountAttribute(): int
    {
        return array_sum(array_column($this->items, 'quantity'));
    }
}
