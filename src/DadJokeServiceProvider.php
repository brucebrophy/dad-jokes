<?php

namespace Brucebrophy\DadJokes;

use Brucebrophy\DadJokes\Console\Joke;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Brucebrophy\DadJokes\Http\Controllers\JokeController;

class DadJokeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('joke', function () {
            return new JokeFactory();
        });

        $this->mergeConfigFrom(
        	__DIR__.'/../config/dad-jokes.php',
			'dad-jokes'
		);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Joke::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dad-jokes');

        $this->publishes([
        	__DIR__.'/../resources/views' => resource_path('views/vendor/dad-jokes'),
		], 'views');

		$this->publishes([
			__DIR__.'/../config/dad-jokes.php' => base_path('config/dad-jokes.php'),
		], 'config');

        Route::get(config('dad-jokes.route'), JokeController::class);
    }
}
