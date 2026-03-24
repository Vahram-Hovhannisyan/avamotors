<?php
// app/Models/Engine.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Engine extends Model
{
    protected $fillable = [
        'car_model_id',
        'name',
        'code',
        'displacement',
        'horsepower',
        'kw',
        'fuel_type',
        'cylinders',
        'valves',
        'fuel_system',
        'turbo',
        'year_from',
        'year_to',
    ];

    protected $casts = [
        'displacement' => 'decimal:1',
        'horsepower' => 'integer',
        'kw' => 'integer',
        'cylinders' => 'integer',
        'year_from' => 'integer',
        'year_to' => 'integer',
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
