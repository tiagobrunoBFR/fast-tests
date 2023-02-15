<?php

use App\Models\Post;
use function Pest\Laravel\postJson;

it('Should create a post comment', function () {
    $data = [
        'description' => 'comment post bla bla',
    ];

    $post = Post::factory()->create();

    postJson(route('posts.comments.store', $post->id), $data)
        ->assertStatus(201)
        ->assertJson([
            'result' => [
                'description' => $data['description'],
                'commentable_type' => Post::class
            ]
        ]);
});
