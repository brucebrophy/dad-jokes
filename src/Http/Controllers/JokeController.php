<?php

namespace Brucebrophy\DadJokes\Http\Controllers;

use Brucebrophy\DadJokes\Facades\Joke;

class JokeController
{
	public function __invoke()
	{
		return view('dad-jokes::joke', [
			'joke' => Joke::random()
		]);
	}
}