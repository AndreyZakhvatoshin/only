<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class CarOrderService
{
    /**
     * Получение доступных к бронированию автомобилей
     * с фильтром по марке и уровню комфорта с пагинацией
     * Логику получения доступных атомобилей оставил в сервисе
     * т.к это уровень бизнес логики, а не отношения модели.
     *
     * @param User $user
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAvailableCars(
        User $user,
        array $filters
    ): LengthAwarePaginator
    {
        $allowedCategoryIds = $user->position?->comfortCategories->pluck('id')->toArray();
        $startTime = Carbon::createFromFormat('Y-m-d G', $filters['start_time']);
        $endTime = Carbon::createFromFormat('Y-m-d G', $filters['end_time']);
        $query = Car::query()
            ->filter($filters)
            ->whereHas('model', function ($q) use ($allowedCategoryIds) {
                $q->whereIn('comfort_category_id', $allowedCategoryIds);
            })
            ->whereDoesntHave('bookings', function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                ->where('end_time', '>', $startTime);
            });

        return $query->with(['model.comfortCategory', 'driver'])->paginate();
    }
}
