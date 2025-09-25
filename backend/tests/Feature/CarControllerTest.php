<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\CarModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;


    public function testManagerSeeTwoCars()
    {
        $user = User::query()->whereHas('position', fn($q) => $q->where('title', 'Менеджер'))->first();

        $this->actingAs($user);

        $response = $this->getJson(route('cars.index',['start_time' => '2025-09-26 10', 'end_time'=> '2025-09-26 12']));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['current_page', 'last_page', 'per_page', 'total']
        ]);

        // Менеджеру доступны категории 2 и 3 ("Вторая", "Третья")
        // Машины: Toyota Camry (категория 2), Hyundai Solaris (категория 3)
        // BMW 5 Series (категория 1) не должна быть в списке
        $response->assertJsonCount(2, 'data');
        $response->assertJsonFragment(['model' => 'Toyota Camry']);
        $response->assertJsonFragment(['model' => 'Hyundai Solaris']);
        $response->assertJsonMissing(['model' => 'BMW 5 Series']);
    }

    public function testDirectorSeeOneCar()
    {
        $user = User::query()->whereHas('position', fn($q) => $q->where('title', 'Директор'))->first();

        $this->actingAs($user);

        $response = $this->getJson(route('cars.index',['start_time' => '2025-09-26 10', 'end_time'=> '2025-09-26 12']));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['current_page', 'last_page', 'per_page', 'total']
        ]);

        // Директору доступна 1 категория ("первая")
        // Машина: BMW 5 Series (категория 1)
        // Toyota Camry (категория 2), Hyundai Solaris (категория 3) не должны быть в списке
        $response->assertJsonCount(1, 'data');
        $response->assertJsonMissing(['model' => 'Toyota Camry']);
        $response->assertJsonMissing(['model' => 'Hyundai Solaris']);
        $response->assertJsonFragment(['model' => 'BMW 5 Series']);
    }

    public function testDriverDontSeeCars()
    {
        $user = User::query()->whereHas('position', fn($q) => $q->where('title', 'Водитель'))->first();

        $this->actingAs($user);

        $response = $this->getJson(route('cars.index',['start_time' => '2025-09-26 10', 'end_time'=> '2025-09-26 12']));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['current_page', 'last_page', 'per_page', 'total']
        ]);

        // Водитель не видит машин для бронирования
        $response->assertJsonCount(0, 'data');
    }

    public function testCarIsNotAvailableIfAlreadyBooked()
    {
        $user = User::query()->whereHas('position', fn($q) => $q->where('title', 'Менеджер'))->first();
        // менеджер может бронировать Toyota
        $car = Car::whereHas('model', function ($q) {
            $q->where('brand', 'Toyota');
        })->first();

        CarBooking::factory()->create([
            'user_id' => $user->id,
            'car_id' => $car->id,
            'start_time' => '2025-09-26 11:00:00',
            'end_time' => '2025-09-26 13:00:00',
        ]);

        $this->actingAs($user);

        $response = $this->getJson(route('cars.index',['start_time' => '2025-09-26 10', 'end_time'=> '2025-09-26 12']));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['current_page', 'last_page', 'per_page', 'total']
        ]);

        // Менеджеру доступны категории 2 и 3 ("Вторая", "Третья")
        // Машины: Toyota Camry уже забронирована на это время, Hyundai Solaris (категория 3)
        $response->assertJsonCount(1, 'data');
        $response->assertJsonMissing(['model' => 'Toyota Camry']);
        $response->assertJsonFragment(['model' => 'Hyundai Solaris']);
        $response->assertJsonMissing(['model' => 'BMW 5 Series']);
    }

    public function testFilterModelCars()
    {
        $user = User::query()->whereHas('position', fn($q) => $q->where('title', 'Менеджер'))->first();
        $modelId = CarModel::query()->where('brand', 'Toyota')->first()->id;

        $this->actingAs($user);

        $response = $this->getJson(route('cars.index',['start_time' => '2025-09-26 10',
            'end_time'=> '2025-09-26 12',
            'model_id' => [$modelId]
            ]));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['current_page', 'last_page', 'per_page', 'total']
        ]);

        // Менеджеру доступны категории 2 и 3 ("Вторая", "Третья")
        // Фильтр по Toyota
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['model' => 'Toyota Camry']);
        $response->assertJsonMissing(['model' => 'Hyundai Solaris']);
        $response->assertJsonMissing(['model' => 'BMW 5 Series']);
    }
}
