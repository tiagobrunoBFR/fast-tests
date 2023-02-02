<?php

use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

test('Should create a post', function () {

    $data = [
        'title' => 'test',
        'description' => 'description bla bla bla bla',
    ];

    post(route('posts.store'), $data)
        ->assertStatus(201)
        ->assertJson([
            'data' => [
                'title' => $data['title'],
                'description' => $data['description'],
                'owner_id' => $this->user->id,
            ]
        ]);
});

test('Should validate data when creating post', function ($data, $errorFieldExpected) {

    postJson(route('posts.store'), $data)
        ->assertStatus(422)
        ->assertJsonValidationErrors($errorFieldExpected);
})->with([
    [['title' => '', 'description' => 'test'], 'title'],
    [['title' => 'test', 'description' => ''], 'description']
]);
