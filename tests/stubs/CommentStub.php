<?php

declare(strict_types = 1);

use Illuminate\Database\Eloquent\Model;

class CommentStub extends Model
{
    use Centrex\LivewireComments\Traits\Commentable;

    protected $connection = 'testbench';

    public $table = 'comments';
}
