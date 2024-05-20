<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!$this->app->isProduction());
        Paginator::useBootstrapFive();

        View::composer('app.nav', function ($view) {
            $brands = Brand::withCount('cars')
                ->orderBy('name')
                ->get();
            $locations = Location::withCount('cars')
                ->orderBy('name')
                ->get();

            $view->with([
                'brands' => $brands,
                'locations' => $locations,
            ]);
        });
    }
}
