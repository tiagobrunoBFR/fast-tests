<?php

namespace App\Http\Controllers;

use App\Exceptions\PostNotFoundException;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = Post::where('owner_id', auth()->id())->paginate();

        return response()->json(['result' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(PostRequest $request)
    {
        $request->merge(['owner_id' => auth()->id()]);

        $post = Post::create($request->all());
        return response()->json(['result' => $post], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     * @throws PostNotFoundException
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            throw new PostNotFoundException();
        }

        return response()->json(['result' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(PostRequest $request, $id)
    {
        $request->merge(['owner_id' => auth()->id()]);

        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return response()->json(['result' => $post], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws PostNotFoundException
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            throw new PostNotFoundException();
        }

        $post->delete();

        return response()->json(['result' => []], 204);
    }
}
