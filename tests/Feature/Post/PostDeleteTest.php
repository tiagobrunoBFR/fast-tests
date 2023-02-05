<?php

use App\Models\Post;
use function Pest\Laravel\deleteJson;

it('Should delete post and return 204', function () {
    $post = Post::factory()->create();
    deleteJson(route('posts.destroy', $post->id))
        ->assertStatus(204);
});

it('Should return a error and 404 when post not exists', function () {
    deleteJson(route('posts.destroy', 20))
        ->assertStatus(404)
        ->assertJson([
            'error' => 'Post not found'
        ]);
});
