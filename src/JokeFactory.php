<?php

namespace Brucebrophy\DadJokes;

class JokeFactory
{
	protected $jokes = [
		'6:30 is my favorite time of day, hands down.',
		'I took up origami for a while, but I gave it up because it was too much paperwork.',
		'I love my furniture. My recliner and I go way back.',
	];

	public function __construct(Array $jokes = [])
	{
		if ($jokes) {
			$this->jokes = $jokes;
		}
	}

	public function random()
	{
		return $this->jokes[array_rand($this->jokes)];
	}
}