<?php

namespace Brucebrophy\DadJokes\Tests;

use Brucebrophy\DadJokes\DadJokeServiceProvider;
use Brucebrophy\DadJokes\Facades\Joke;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            DadJokeServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Joke' => Joke::class,
        ];
    }

    public function testConsoleCommandReturnsAJoke()
    {
        $this->withoutMockingConsoleOutput();

        $joke = 'Why don’t skeletons ever go trick or treating? Because they have nobody to go with.';

        Joke::shouldReceive('random')
            ->once()
            ->andReturn($joke);

        $this->artisan('joke');

        $output = Artisan::output();

        $this->assertSame($joke.PHP_EOL, $output);
    }
}
