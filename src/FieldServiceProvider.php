<?php

namespace R64\NovaFields;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-fields', __DIR__.'/../dist/js/field.js');
        });

        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Get the Nova route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration(): array
    {
        return [
            'namespace' => 'R64\NovaFields\Http\Controllers',
            'domain' => config('nova.domain', null),
            'as' => 'nova.r64.api.',
            'prefix' => 'nova-r64-api',
            'middleware' => 'nova',
        ];
    }
}
