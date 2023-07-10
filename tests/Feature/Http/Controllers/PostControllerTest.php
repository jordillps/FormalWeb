<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewPost;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Notification\ReviewNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PostController
 */
class PostControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('post.index'));

        $response->assertOk();
        $response->assertViewIs('post.index');
        $response->assertViewHas('posts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('post.create'));

        $response->assertOk();
        $response->assertViewIs('post.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PostController::class,
            'store',
            \App\Http\Requests\PostStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $url = $this->faker->url;
        $excerpt = $this->faker->text;
        $body = $this->faker->text;
        $published_at = $this->faker->dateTime();

        Notification::fake();
        Event::fake();

        $response = $this->post(route('post.store'), [
            'title' => $title,
            'url' => $url,
            'excerpt' => $excerpt,
            'body' => $body,
            'published_at' => $published_at,
        ]);

        $posts = Post::query()
            ->where('title', $title)
            ->where('url', $url)
            ->where('excerpt', $excerpt)
            ->where('body', $body)
            ->where('published_at', $published_at)
            ->get();
        $this->assertCount(1, $posts);
        $post = $posts->first();

        $response->assertRedirect(route('post.index'));
        $response->assertSessionHas('post.title', $post->title);

        Notification::assertSentTo($post->author, ReviewNotification::class, function ($notification) use ($post) {
            return $notification->post->is($post);
        });
        Event::assertDispatched(NewPost::class, function ($event) use ($post) {
            return $event->post->is($post);
        });
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.show', $post));

        $response->assertOk();
        $response->assertViewIs('post.show');
        $response->assertViewHas('post');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.edit', $post));

        $response->assertOk();
        $response->assertViewIs('post.edit');
        $response->assertViewHas('post');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PostController::class,
            'update',
            \App\Http\Requests\PostUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $post = Post::factory()->create();
        $title = $this->faker->sentence(4);
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->put(route('post.update', $post), [
            'title' => $title,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $post->refresh();

        $response->assertRedirect(route('post.index'));
        $response->assertSessionHas('post.id', $post->id);

        $this->assertEquals($title, $post->title);
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals($category->id, $post->category_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('post.destroy', $post));

        $response->assertRedirect(route('post.index'));

        $this->assertSoftDeleted($post);
    }
}
