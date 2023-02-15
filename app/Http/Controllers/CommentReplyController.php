<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Service\CommentService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentReplyController extends Controller
{
    public function __construct(
        private readonly CommentService $commentService
    ){}

    /**
     * @param CommentRequest $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request, Comment $comment)
    {
        $result = $this->commentService->create(
            $request->description,
            Comment::class,
            $comment->id
        );

        return response()->json(['result' => $result], Response::HTTP_CREATED);
    }
}
