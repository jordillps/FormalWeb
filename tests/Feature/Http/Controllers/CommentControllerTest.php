<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommentController
 */
class CommentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $comments = Comment::factory()->count(3)->create();

        $response = $this->get(route('comment.index'));

        $response->assertOk();
        $response->assertViewIs('comment.index');
        $response->assertViewHas('comments');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommentController::class,
            'store',
            \App\Http\Requests\CommentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $body = $this->faker->text;
        $author = $this->faker->word;
        $author_email = $this->faker->word;

        $response = $this->post(route('comment.store'), [
            'body' => $body,
            'author' => $author,
            'author_email' => $author_email,
        ]);

        $comments = Comment::query()
            ->where('body', $body)
            ->where('author', $author)
            ->where('author_email', $author_email)
            ->get();
        $this->assertCount(1, $comments);
        $comment = $comments->first();
    }
}
