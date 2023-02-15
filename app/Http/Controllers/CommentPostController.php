<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentPostController extends Controller
{
    /**
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePostComment(CommentRequest $request, Post $post)
    {
        $comment = Comment::create([
            'description' => $request->description,
            'commentable_id' => $post->id,
            'commentable_type' => Post::class,
            'owner_id' => Auth::id()
        ]);

        return response()->json(['result' => $comment], Response::HTTP_CREATED);
    }
}
