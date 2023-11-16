<?php

declare(strict_types=1);

namespace Centrex\LivewireComments\Traits;

trait HasUserAvatar
{
    public function avatar(): string
    {
        return 'https://gravatar.com/avatar/'.md5($this->email).'?s=80&d=mp';
    }
}
