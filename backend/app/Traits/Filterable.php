<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Filterable
{
    /**
     * @param Builder<Model> $query
     * @param array<string, mixed> $params
     * @return Builder<Model>
     * @throws Exception
     */
    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        $filter = new $this->filterClass();

        return $filter->apply($query, $params);
    }
}
