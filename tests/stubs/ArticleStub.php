<?php

use Illuminate\Database\Eloquent\Model;
use Centrexbd\LivewireComments\Scopes\CommentScopes;

class ArticleStub extends Model
{
    use \Centrexbd\LivewireComments\Traits\Commentable;

    protected $connection = 'testbench';

    public $table = 'articles';

}
