<?php
namespace Moviet\Minity;

use Illuminate\Support\ServiceProvider;

class MinilyServiceProvider extends ServiceProvider
{
    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('minily.php')
        ]);
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
    public function register()
    {
        $this->app->singleton('minily', function($app) {
            return new Minily($this->config());
        });
    }

    /**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
    public function provides()
    {
        return ['minily'];
    }

    /**
     * Get the base settings from config file
     *
     * @return array
     */
    public function config()
    {
        $config = config('minily');

        if (empty($config['environment'])) {
            $config['environment'] = app()->environment();
        }

        if (empty($config['public_path'])) {
            $config['public_path'] = public_path();
        }

        if (empty($config['asset'])) {
            $config['asset'] = asset('');
        }

        return $config;
    }
}
