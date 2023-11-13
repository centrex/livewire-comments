<?php

use Illuminate\Database\Eloquent\Model;
use Centrexbd\LivewireComments\Scopes\CommentScopes;

class EpisodeStub extends Model
{
    use \Centrexbd\LivewireComments\Traits\Commentable;

    protected $connection = 'testbench';

    public $table = 'episodes';

}
