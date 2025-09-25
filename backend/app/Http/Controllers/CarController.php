<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCarFilterRequest;
use App\Http\Resources\CarListResource;
use App\Services\CarOrderService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarController extends Controller
{
    public function index(OrderCarFilterRequest $request, CarOrderService $service): AnonymousResourceCollection
    {
        $user = $request->user();
        $data = $request->validated();

        $cars = $service->getAvailableCars($user, $data);

        return CarListResource::collection($cars);
    }
}
