<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\{FetchPostsWithFilterRequest, CreatePostRequest};
use App\Services\Posts\PostsService;
use App\Http\Resources\Posts\PostsResource;
use Illuminate\Support\Facades\DB;
class PostApiController extends Controller
{
    protected $postsService;

    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
    }

    /*
    * FETCH LOGS WITH FILTERATION
    * @param FetchPostsWithFilterRequest $request
    * @return Collection PostsResource
    */

    public function getPostsWithFilter(FetchPostsWithFilterRequest $request)
    {
        try {
            // dd($request->getDTO());
            $posts = $this->postsService->getPostsWithFilter($request->getDTO());
            return PostsResource::collection($posts);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /*
    * FETCH LOG DETAILS
    * @param $id
    * @return new PostsResource
    */
    public function viewPostDetails($id)
    {
        try {
            // dd($request->getDTO());
            $post = $this->postsService->viewPostDetails($id);
            return new PostsResource($post);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /*
    * FETCH LOG DETAILS
    * @param $id
    * @return new PostsResource
    */
    public function createPost(CreatePostRequest $request)
    {
        try {
            // dd($request->getDTO());

            $post = $this->postsService->createPost($request->getDTO(), $request->file('image'));

            return $post;

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function userPosts($id)
    {
        try {
            $posts = $this->postsService->userPosts($id);
            return PostsResource::collection($posts);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}
