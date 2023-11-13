<?php

use Illuminate\Database\Eloquent\Model;
use Centrex\LivewireComments\Scopes\CommentScopes;

class EpisodeStub extends Model
{
    use \Centrex\LivewireComments\Traits\Commentable;

    protected $connection = 'testbench';

    public $table = 'episodes';

}
