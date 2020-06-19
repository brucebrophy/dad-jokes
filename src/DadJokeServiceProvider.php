<?php

namespace Brucebrophy\DadJokes;

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
    }
}
