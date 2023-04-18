<?php

namespace Enfil\Laravel\DddCqrs\Modules;

use Nwidart\Modules;

class LaravelModulesServiceProvider extends Modules\LaravelModulesServiceProvider
{
    protected function registerNamespaces()
    {
        $configPath = __DIR__ . '/../config/config.php';

        $this->publishes([
            $configPath => config_path('modules.php'),
        ], 'config');
    }

    protected function registerProviders()
    {
        parent::registerProviders();
        $this->app->register(ModuleGeneratorServiceProvider::class);
    }
}
