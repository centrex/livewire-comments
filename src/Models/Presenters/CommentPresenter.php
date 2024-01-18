<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments\Models\Presenters;

use Centrex\LivewireComments\Models\{Comment, User};
use Illuminate\Support\HtmlString;

class CommentPresenter
{
    public Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function markdownBody(): HtmlString
    {
        return new HtmlString(app('markdown')->convertToHtml($this->comment->body));
    }

    public function relativeCreatedAt(): mixed
    {
        return $this->comment->created_at->diffForHumans();
    }

    public function replaceUserMentions($text): array|string
    {
        preg_match_all('/@([A-Za-z0-9_]+)/', $text, $matches);
        $usernames = $matches[1];
        $replacements = [];

        foreach ($usernames as $username) {
            $user = User::where('name', $username)->first();

            if ($user) {
                $userRoutePrefix = config('commentify.users_route_prefix', 'users');

                $replacements['@' . $username] = '<a href="/' . $userRoutePrefix . '/' . $username . '">@' . $username .
                    '</a>';
            } else {
                $replacements['@' . $username] = '@' . $username;
            }
        }

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }
}
