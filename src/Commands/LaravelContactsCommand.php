<?php

namespace LucaLongo\LaravelContacts\Commands;

use Illuminate\Console\Command;

class LaravelContactsCommand extends Command
{
    public $signature = 'laravel-contacts';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
