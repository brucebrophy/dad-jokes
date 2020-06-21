<?php

namespace Brucebrophy\DadJokes\Console;

use Brucebrophy\DadJokes\Facades\Joke as JokeFacade;
use Illuminate\Console\Command;

class Joke extends Command
{
    protected $signature = 'joke';

    protected $description = 'Display a funny dad joke';

    public function handle()
    {
        $this->info(JokeFacade::random());
    }
}
