<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Http\Livewire;

use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Foundation\Application;
use Livewire\Component;

class Like extends Component
{
    public $comment;

    public $count;

    public function mount(\Centrex\LivewireComments\Models\Comment $comment): void
    {
        $this->comment = $comment;
        $this->count = $comment->likes_count;
    }

    public function like(): void
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();

        if ($this->comment->isLiked()) {
            $this->comment->removeLike();

            $this->count--;
        } elseif (auth()->user()) {
            $this->comment->likes()->create([
                'user_id' => auth()->id(),
            ]);

            $this->count++;
        } elseif ($ip && $userAgent) {
            $this->comment->likes()->create([
                'ip'         => $ip,
                'user_agent' => $userAgent,
            ]);

            $this->count++;
        }
    }

    public function render(
    ): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|null {
        return view('livewire-comments::livewire.like');
    }
}
