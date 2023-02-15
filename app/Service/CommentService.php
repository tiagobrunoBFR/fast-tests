<?php

namespace App\Service;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function __construct(
        private readonly Comment $comment
    ){}

    public function create(string $description, string $type, int $id): Comment
    {
        return $this->comment->create([
            'description' => $description,
            'commentable_id' => $id,
            'commentable_type' => $type,
            'owner_id' => Auth::id()
        ]);
    }
}
