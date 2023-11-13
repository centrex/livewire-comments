<?php

namespace Centrex\LivewireComments\Traits;

trait HasUserAvatar
{

    /**
     * @return string
     */
    public function avatar(): string
    {
        return 'https://gravatar.com/avatar/'.md5($this->email).'?s=80&d=mp';
    }
}
