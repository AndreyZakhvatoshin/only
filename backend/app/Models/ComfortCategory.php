<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComfortCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ComfortCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'level'
    ];

    /**
     * @return BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(
            Position::class,
            'position_comfort_category'
        );
    }

    /**
     * @return HasMany
     */
    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
