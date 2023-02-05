<?php

use App\Models\Post;
use function Pest\Laravel\getJson;

it('should list posts create by user auth', function () {
    Post::factory()->count(10)->create(['owner_id' => $this->user->id]);
    Post::factory()->create();

    getJson(route('posts.index'))
     ->assertStatus(200)
     ->assertJsonCount(10, 'result.data');
});
