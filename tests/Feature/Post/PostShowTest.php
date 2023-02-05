<?php

use App\Models\Post;
use function Pest\Laravel\getJson;

it('Should return post by id', function () {
    $post = Post::factory()->create();

    getJson(route('posts.show', $post->id))
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'title' => $post->title,
                'description' => $post->description,
            ]
        ]);
});

it('Should return a error and status code 404 when post not found', function () {

    getJson(route('posts.show', 12))
        ->assertStatus(404)
        ->assertJson([
            'error' => 'Post not found'
        ]);
});
