<?php

namespace Brucebrophy\DadJokes;

use Brucebrophy\DadJokes\Console\Joke;
use Illuminate\Support\ServiceProvider;

class DadJokeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('joke', function () {
            return new JokeFactory();
        });
    }

    public function boot()
    {
		if ($this->app->runningInConsole()) {
			$this->commands([
				Joke::class,
			]);
		}
    }
}
