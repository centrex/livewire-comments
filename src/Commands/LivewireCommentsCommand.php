<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Commands;

use Illuminate\Console\Command;

class LivewireCommentsCommand extends Command
{
    public $signature = 'livewire-comments';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
