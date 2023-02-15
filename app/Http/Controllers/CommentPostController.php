<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Service\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentPostController extends Controller
{
    public function __construct(
        private readonly CommentService $commentService
    ){}

    /**
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePostComment(CommentRequest $request, Post $post)
    {
        $comment = $this->commentService->create(
            $request->description,
            Post::class,
            $post->id
        );

        return response()->json(['result' => $comment], Response::HTTP_CREATED);
    }
}
