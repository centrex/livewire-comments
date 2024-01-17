<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Http\Livewire;

use Centrex\LivewireComments\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Comment extends Component
{
    use AuthorizesRequests;

    public $comment;

    public $users = [];

    public $isReplying = false;

    public $hasReplies = false;

    public $showOptions = false;

    public $isEditing = false;

    public $replyState = [
        'body' => '',
    ];

    public $editState = [
        'body' => '',
    ];

    protected $validationAttributes = [
        'replyState.body' => 'Reply',
        'editState.body'  => 'Reply',
    ];

    public function updatedIsEditing($isEditing): void
    {
        if (!$isEditing) {
            return;
        }
        $this->editState = [
            'body' => $this->comment->body,
        ];
    }

    /** @throws AuthorizationException */
    public function editComment(): void
    {
        $this->authorize('update', $this->comment);
        $this->validate([
            'editState.body' => 'required|min:2',
        ]);
        $this->comment->update($this->editState);
        $this->isEditing   = false;
        $this->showOptions = false;
    }

    /** @throws AuthorizationException */
    public function deleteComment(): void
    {
        $this->authorize('destroy', $this->comment);
        $this->comment->delete();
        $this->showOptions = false;
    }

    public function render(
    ): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|null {
        return view('livewire-comments::livewire.comment');
    }

    #[On('refresh')]
    public function postReply(): void
    {
        if (!$this->comment->isParent()) {
            return;
        }
        $this->validate([
            'replyState.body' => 'required',
        ]);
        $reply = $this->comment->children()->make($this->replyState);
        $reply->user()->associate(auth()->user());
        $reply->commentable()->associate($this->comment->commentable);
        $reply->save();

        $this->replyState = [
            'body' => '',
        ];
        $this->isReplying  = false;
        $this->showOptions = false;
        $this->dispatch('refresh')->self();
    }

    public function selectUser($userName): void
    {
        if ($this->replyState['body']) {
            $this->replyState['body'] = preg_replace(
                '/@(\w+)$/',
                '@' . str_replace(' ', '_', Str::lower($userName)) . ' ',
                $this->replyState['body'],
            );
            //            $this->replyState['body'] =$userName;
            $this->users = [];
        } elseif ($this->editState['body']) {
            $this->editState['body'] = preg_replace(
                '/@(\w+)$/',
                '@' . str_replace(' ', '_', Str::lower($userName)) . ' ',
                $this->editState['body'],
            );
            $this->users = [];
        }
    }

    #[On('getUsers')]
    public function getUsers($searchTerm): void
    {
        if (!empty($searchTerm)) {
            $this->users = User::where('name', 'like', '%' . $searchTerm . '%')->take(5)->get();
        } else {
            $this->users = [];
        }
    }
}
