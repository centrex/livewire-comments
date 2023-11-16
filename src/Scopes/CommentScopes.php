<?php

declare(strict_types=1);

namespace Centrex\LivewireComments\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CommentScopes
{
    public function scopeParent(Builder $builder): void
    {
        $builder->whereNull('parent_id');
    }
}
