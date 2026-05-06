<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Centrex\LivewireComments\LivewireComments
 */
class LivewireComments extends Facade
{
    #[\Override]
    protected static function getFacadeAccessor()
    {
        return \Centrex\LivewireComments\LivewireComments::class;
    }
}
