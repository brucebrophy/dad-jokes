<?php

namespace Brucebrophy\DadJokes\Tests;

use Brucebrophy\DadJokes\DadJokeServiceProvider;
use Brucebrophy\DadJokes\Facades\Joke as JokeFacade;
use Brucebrophy\DadJokes\Models\Joke;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__.'/../database/migrations/create_jokes_table.php.stub';

        (new \CreateJokesTable)->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            DadJokeServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Joke' => JokeFacade::class,
        ];
    }

    public function testConsoleCommandReturnsAJoke()
    {
        $this->withoutMockingConsoleOutput();

        $joke = 'Why don’t skeletons ever go trick or treating? Because they have nobody to go with.';

        JokeFacade::shouldReceive('random')
            ->once()
            ->andReturn($joke);

        $this->artisan('joke');

        $output = Artisan::output();

        $this->assertSame($joke.PHP_EOL, $output);
    }

    public function testRouteCanBeAccessed()
    {
        JokeFacade::shouldReceive('random')
            ->once()
            ->andReturn('A joke');

        $this->get('/joke')
            ->assertViewIs('dad-jokes::joke')
            ->assertViewHas('joke', 'A joke')
            ->assertStatus(200);
    }

    public function testDatabaseCanBeAccessed()
    {
        $joke = new Joke;
        $joke->joke = 'a funny joke';
        $joke->save();

        $newJoke = Joke::find($joke->id);

        $this->assertSame($newJoke->joke, 'a funny joke');
    }
}
