<?php

declare(strict_types=1);

namespace Centrex\LivewireComments\Models;

use Centrex\LivewireComments\Database\Factories\UserFactory;
use Centrex\LivewireComments\Traits\HasUserAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    use HasFactory, HasUserAvatar;

    /** @var string */
    protected $table = 'users';

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CommentLike::class);
    }
}
