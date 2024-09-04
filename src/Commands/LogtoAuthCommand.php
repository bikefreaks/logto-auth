<?php

namespace bikefreaks\LogtoAuth\Commands;

use Illuminate\Console\Command;

class LogtoAuthCommand extends Command
{
    public $signature = 'logto-auth';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
