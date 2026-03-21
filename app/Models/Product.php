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
}
