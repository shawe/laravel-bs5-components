<?php

namespace Laravel\Bootstrap\Components\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelBS5ComponentsProvider extends ServiceProvider
{
    /**
     * Repo's name.
     *
     * @var string
     */
    private $name = 'laravel-bs5-components';

    /**
     * Namespace to call from views.
     *
     * @var string
     */
    private $namespace = 'bs5';

    /**
     *
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', $this->namespace);

        $this->publishes(
            [__DIR__ . '/../../config/' . $this->name . '.php' => config_path($this->name . '.php')],
            [$this->name, $this->name . ':config']
        );

        $this->publishes(
            [__DIR__ . '/../../resources/views' => resource_path('views/vendor/bs')],
            [$this->name, $this->name . ':views']
        );
    }

    /**
     * Register any application services.
 *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/' . $this->name . '.php', $this->name);
    }
}
