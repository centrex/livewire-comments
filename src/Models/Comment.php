<?php

declare(strict_types=1);

namespace Centrex\LivewireComments\Models;

use Centrex\LivewireComments\Database\Factories\CommentFactory;
use Centrex\LivewireComments\Models\Presenters\CommentPresenter;
use Centrex\LivewireComments\Scopes\CommentScopes;
use Centrex\LivewireComments\Scopes\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use CommentScopes, HasFactory, HasLikes, SoftDeletes;

    /** @var string */
    protected $table = 'comments';

    /** @var string[] */
    protected $fillable = ['body'];

    protected $withCount = [
        'likes',
    ];

    public function presenter(): CommentPresenter
    {
        return new CommentPresenter($this);
    }

    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->oldest();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function newFactory(): CommentFactory
    {
        return CommentFactory::new();
    }
}
