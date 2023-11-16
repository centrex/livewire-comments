<?php

declare(strict_types=1);

namespace Centrex\LivewireComments\Traits;

use Centrex\LivewireComments\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Commentable
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
