<?php

use App\Models\Comment;
use function Pest\Laravel\postJson;

it('Should create a comment reply', function () {
    $data = [
        'description' => 'comment reply bla bla',
    ];

    $comment = Comment::factory()->create();
    $reply = Comment::factory()->create([
        'description' => 'comment reply',
        'commentable_id' => $comment->id,
        'commentable_type' => Comment::class
    ]);

    postJson(route('comments.replies.store', $reply->id), $data)
        ->assertStatus(201)
        ->assertJson([
            'result' => [
                'description' => $data['description'],
                'commentable_type' => Comment::class
            ]
        ]);
});
