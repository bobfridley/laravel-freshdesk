<?php
/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Freshdesk;

use Freshdesk\Client;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
/**
 * This is the freshdesk service provider class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class FreshdeskServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }
    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/freshdesk.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('freshdesk.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('freshdesk');
        }
        $this->mergeConfigFrom($source, 'freshdesk');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }
    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('freshdesk.factory', function () {
            return new FreshdeskFactory();
        });
        $this->app->alias('freshdesk.factory', FreshdeskFactory::class);
    }
    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('freshdesk', function (Container $app) {
            $config = $app['config'];
            $factory = $app['freshdesk.factory'];
            return new FreshdeskManager($config, $factory);
        });
        $this->app->alias('freshdesk', FreshdeskManager::class);
    }
    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('freshdesk.connection', function (Container $app) {
            $manager = $app['freshdesk'];
            return $manager->connection();
        });
        $this->app->alias('freshdesk.connection', Client::class);
    }
    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'freshdesk.factory',
            'freshdesk',
            'freshdesk.connection',
        ];
    }
}