<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Analog extends Model
{
    protected $fillable = ['brand', 'sku', 'note'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_analog');
    }

    // Полное название: "Bosch FR7DCX"
    public function fullName(): string
    {
        return $this->brand . ' ' . $this->sku;
    }
}
