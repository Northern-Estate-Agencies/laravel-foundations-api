<?php

namespace NorthernEstateAgencies\ReapitFoundations;

use Illuminate\Support\ServiceProvider;

class ReapitFoundationsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Foundations::class, function () {
            return new Foundations(env('AUTH_TOKEN'), 'MNS');
        });
    }

    public function boot()
    {
    }
}
