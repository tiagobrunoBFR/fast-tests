<?php

use App\Models\Post;
use function Pest\Laravel\putJson;

it('Should update post and return 200', function () {

    $post = Post::factory()->create([
        'title' => 'title test',
        'description' => 'description test'
    ]);

    $data = [
        'title' => 'title update',
        'description' => 'description update',
    ];

    putJson(route('posts.update', $post->id), $data)
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'title' => $data['title'],
                'description' => $data['description']
            ]
        ]);
});
