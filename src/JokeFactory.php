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
        $response = $this->client->get(self::API_ENDPOINT);

        $joke = json_decode($response->getBody()->getContents());

        return $joke->joke;
    }
}
