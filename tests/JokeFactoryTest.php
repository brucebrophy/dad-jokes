<?php

namespace Brucebrophy\DadJokes\Tests;

use Brucebrophy\DadJokes\JokeFactory;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {
        $jokes = new JokeFactory([
            'This is a joke',
        ]);
        $joke = $jokes->random();

        $this->assertSame('This is a joke', $joke);
    }

    /** @test */
    public function it_returns_a_predefined_joke()
    {
        $dadJokes = [
            '6:30 is my favorite time of day, hands down.',
            'I took up origami for a while, but I gave it up because it was too much paperwork.',
            'I love my furniture. My recliner and I go way back.',
        ];

        $jokes = new JokeFactory();

        $joke = $jokes->random();

        $this->assertContains($joke, $dadJokes);
    }
}
