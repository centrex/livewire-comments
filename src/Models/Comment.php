<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Models;

use Centrex\LivewireComments\Database\Factories\CommentFactory;
use Centrex\LivewireComments\Models\Presenters\CommentPresenter;
use Centrex\LivewireComments\Scopes\{CommentScopes, HasLikes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, MorphTo};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Comment extends Model
{
    use CommentScopes;
    use HasFactory;
    use HasLikes;
    use SoftDeletes;

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
