<?php

namespace App\Service;

use App\Exceptions\PostNotFoundException;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostService
{

    public function __construct(
        private readonly Post $post
    ){}

    public function create(PostRequest $request): Post
    {
        return $this->post->create([
            'title' => $request->title,
            'description' => $request->description,
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

    public function update(PostRequest $request, int $id): Post
    {
        $post = $this->findById($id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return $post;
    }

    public function delete($id): void
    {
        $post = $this->findById($id);
        $post->delete();
    }
}
