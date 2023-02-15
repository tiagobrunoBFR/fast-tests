<?php

namespace App\Http\Controllers;

use App\Exceptions\PostNotFoundException;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Service\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function __construct(
       private readonly PostService $postService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = $this->postService->index();

        return response()->json(['result' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        $post = $this->postService->create($request);
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
        $post = $this->postService->findById($id);

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
        $post = $this->postService->update($request, $id);

        return response()->json(['result' => $post]);
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
        $this->postService->delete($id);
        return response()->json(['result' => []], 204);
    }
}
