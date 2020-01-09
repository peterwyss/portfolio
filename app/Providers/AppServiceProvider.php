<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config([
            'global' => Setting::all([
                'name', 'value'
            ])
            ->keyBy('name')
            ->transform(function ($setting){
                return $setting->value;
            })
            ->toArray
            ()
        ]);     

        config(['app.name' => config('global.name')]);
        config(['app.sub-title' => config('global.sub-title')]);
        config(['app.debug' => config('global.debug')]);

    }
}
