<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    CompanyRepositoryInterface, CompanyRepository,
    UserRepositoryInterface, UserRepository,
    ClientRepositoryInterface, ClientRepository,
    OrderRepositoryInterface, OrderRepository,
    DeliveryTruckRepositoryInterface, DeliveryTruckRepository
};
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(DeliveryTruckRepositoryInterface::class, DeliveryTruckRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
