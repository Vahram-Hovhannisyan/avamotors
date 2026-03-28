<?php
// app/Models/CarModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    protected $fillable = [
        'car_make_id', 'name',
        'year_from', 'year_to',
        'body_type', 'generation',
    ];

    protected $casts = [
        'year_from' => 'integer',
        'year_to'   => 'integer',
    ];

    // ── Отношения ──────────────────────────────────────────────

    public function carMake(): BelongsTo
    {
        return $this->belongsTo(CarMake::class);
    }

    public function engines(): HasMany
    {
        return $this->hasMany(CarEngine::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_car_model')
            ->withPivot('engine_id');
    }

    // ── Хелперы ────────────────────────────────────────────────

    /** Диапазон годов: "2018 – 2023" или "2018 – н.в." */
    public function getYearRangeAttribute(): string
    {
        if (!$this->year_from) return '';
        $to = $this->year_to ?? 'н.в.';
        return "{$this->year_from} – {$to}";
    }

    /** Полное название для отображения: "Camry VII (2018–2023) · Седан" */
    public function getFullLabelAttribute(): string
    {
        $parts = [$this->name];
        if ($this->generation) $parts[] = $this->generation;
        if ($this->year_from)  $parts[] = '(' . $this->year_range . ')';
        if ($this->body_type)  $parts[] = '· ' . $this->body_type;
        return implode(' ', $parts);
    }

    // ── Годы выпуска этой модели (массив для select) ──────────

    public function getYearsArray(): array
    {
        if (!$this->year_from) return [];
        $to = $this->year_to ?? (int) date('Y');
        return range($this->year_from, $to);
    }
}
