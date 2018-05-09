<?php namespace Padosoft\Laravel\Https;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Padosoft\Laravel\Https\Middleware\HttpsForceMiddleware;

class LaravelHttpsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('HttpsForce', [HttpsForceMiddleware::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/config.php';
        $this->mergeConfigFrom($configPath, 'laravel-https');
        $this->publishes([$configPath => config_path('laravel-https.php')], 'laravel-https');
    }
}

