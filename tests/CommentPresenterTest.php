<?php

declare(strict_types = 1);

use Centrex\LivewireComments\Models\{Comment, User};
use Centrex\LivewireComments\Models\Presenters\CommentPresenter;
use Illuminate\Support\HtmlString;

class CommentPresenterTest extends TestCase
{
    public $article;

    /**
     * @var Illuminate\Database\Eloquent\Collection<int, Illuminate\Database\Eloquent\Model>|Illuminate\Database\Eloquent\Model
     */
    public $user;

    /** @var Comment */
    protected $comment;

    /** @var CommentPresenter */
    protected $commentPresenter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = ArticleStub::create([
            'slug' => Illuminate\Support\Str::slug('Article One'),
        ]);
        $this->user = User::factory()->create();

        $this->comment = $this->article->comments()->create([
            'body'             => 'This is a test comment',
            'commentable_type' => '\ArticleStub',
            'commentable_id'   => $this->article->id,
            'user_id'          => $this->user->id,
            'parent_id'        => null,
            'created_at'       => date('Y-m-d H:i:s', strtotime('-1 hour')),
        ]);

        $this->commentPresenter = new CommentPresenter($this->comment);
    }

    /** @test */
    public function it_can_convert_comment_body_to_markdown_html(): void
    {
        $expectedOutput = 'This is a test comment';
        $this->assertEquals(
            new HtmlString(app('markdown')->convertToHtml($expectedOutput)),
            $this->commentPresenter->markdownBody(),
        );
    }

    /** @test */
    public function it_can_get_relative_created_at_time(): void
    {
        $expectedOutput = '1 hour ago';
        $this->assertEquals($expectedOutput, $this->commentPresenter->relativeCreatedAt());
    }

    /** @test */
    public function it_can_replace_user_mentions_in_text_with_links(): void
    {
        $expectedOutput = 'Hello <a href="/users/usama">@usama</a>, this is a test comment mentioning!';
        $this->assertEquals($expectedOutput, $this->commentPresenter->replaceUserMentions($expectedOutput));
    }
}
