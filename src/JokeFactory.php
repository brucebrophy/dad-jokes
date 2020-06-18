<?php

namespace Brucebrophy\DadJokes;

use GuzzleHttp\Client;

class JokeFactory
{
    const API_ENDPOINT = 'https://icanhazdadjoke.com/';

    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    public function random()
    {
        $response = $this->client->get(self::API_ENDPOINT, [
            'headers' => [
                'Accept'     => 'application/json',
            ],
        ]);

        $joke = json_decode($response->getBody()->getContents());

        return $joke->joke;
    }
}
