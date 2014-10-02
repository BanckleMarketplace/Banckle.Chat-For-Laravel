<?php 
namespace Banckle\Chat;

use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider {

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
        $this->package('banckle/chat');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	$this->app['banckle'] = $this->app->share(function($app)
        {
            return new Chat(\Config::get('chat::config'));
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('BanckleChat', 'Banckle\Chat\Facades\Chat');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('banckle');
    }

}
