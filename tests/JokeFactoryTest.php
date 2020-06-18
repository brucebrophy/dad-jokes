<?php

namespace Brucebrophy\DadJokes\Tests;

use Brucebrophy\DadJokes\JokeFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], '{
			  "id": "R7UfaahVfFd",
			  "joke": "My dog used to chase people on a bike a lot. It got so bad I had to take his bike away.",
			  "status": 200
			}'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);
        $jokes = new JokeFactory($client);
        $joke = $jokes->random();

        $this->assertSame('My dog used to chase people on a bike a lot. It got so bad I had to take his bike away.', $joke);
    }
}
