<?php

use Illuminate\Database\Eloquent\Model;
use Centrex\LivewireComments\Scopes\CommentScopes;

class ArticleStub extends Model
{
    use \Centrex\LivewireComments\Traits\Commentable;

    protected $connection = 'testbench';

    public $table = 'articles';

}
