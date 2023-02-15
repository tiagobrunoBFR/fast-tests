<?php

namespace App\Service;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function __construct(
        private readonly Post $post
    ){}

    public function create(string $title, string $description): Post
    {
        return $this->post->create([
            'title' => $title,
            'description' => $description,
            'owner_id' => auth()->id()
        ]);
    }

    public function index(): LengthAwarePaginator
    {
        return $this->post->where('owner_id', auth()->id())->paginate();
    }

    public function findById(int $id): Post
    {
        $post = $this->post->find($id);

        if (!$post) {
            throw new PostNotFoundException();
        }

        return $post;
    }

    public function update(string $title, string $description, int $id): Post
    {
        $post = $this->findById($id);

        $post->update([
            'title' => $title,
            'description' => $description
        ]);

        return $post;
    }

    public function delete($id): void
    {
        $post = $this->findById($id);
        $post->delete();
    }
}
