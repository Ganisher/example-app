<?php


namespace Tests\Api;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_read_post()
    {
        $post = Post::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/posts/'. $post->id
        );

        $this->assertApiResponse($post->toArray());
    }

    /**
     * @test
     */
    public function test_update_post()
    {
        $post = Post::factory()->create();
        $editedPost = Post::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/posts/'. $post->id,
            $editedPost
        );

        $this->assertApiResponse($editedPost);
    }

    /**
     * @test
     */
    public function test_delete_post()
    {
        $post = Post::factory()->create();

        $this->response = $this->json(
            'DELETE',
            '/api/posts/'. $post->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/posts/'. $post->id
        );

        $this->response->assertStatus(404);
    }
}
