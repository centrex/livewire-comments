<?php

namespace Centrex\LivewireComments\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Centrex\LivewireComments\Models\Comment;

trait Commentable
{

    /**
     * @return MorphMany
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
