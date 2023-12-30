<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Policies;

use Centrex\LivewireComments\Models\Comment;
use Illuminate\Auth\Access\{HandlesAuthorization, Response};

class CommentPolicy
{
    use HandlesAuthorization;

    public function update($user, Comment $comment): Response
    {
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }

    public function destroy($user, Comment $comment): Response
    {
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }
}
