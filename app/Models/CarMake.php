<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarMake extends Model
{
    protected $fillable = [
        'name',
    ];

    // Убираем лишние поля, которых нет в таблице
    // protected $casts = [];

    /**
     * Связь с моделями автомобилей
     */
    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'car_make_id');
    }

}
