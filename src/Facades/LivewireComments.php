<?php

namespace Centrexbd\LivewireComments\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Centrexbd\LivewireComments\LivewireComments
 */
class LivewireComments extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Centrexbd\LivewireComments\LivewireComments::class;
    }
}