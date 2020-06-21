<?php

namespace Brucebrophy\DadJokes\Console;

use Illuminate\Console\Command;
use Brucebrophy\DadJokes\Facades\Joke as JokeFacade;

class Joke extends Command
{
	protected $signature = 'joke';

	protected $description = 'Display a funny dad joke';

	public function handle()
	{
		$this->info(JokeFacade::random());
	}
}