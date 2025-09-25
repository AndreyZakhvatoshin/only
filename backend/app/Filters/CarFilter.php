<?php

declare(strict_types=1);

namespace App\Filters;

class CarFilter extends QueryFilter
{
    /**
     * @param array $value
     * @return void
     */
    public function modelId(array $value): void
    {
        $this->builder->whereHas('model', fn($query) => $query->whereIn('id', $value));
    }

    public function comfortLevel(array $value): void
    {
        $this->builder->whereHas('model', fn($query) => $query->whereIn('id', $value));
    }
}
