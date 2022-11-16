<?php

namespace App\Services\Posts;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\DTOs\Posts\{FetchPostsWithFilterDTO, CreatePostDTO};
use App\Models\{Post, User};
use Illuminate\Database\Eloquent\Builder;
use App\Events\NotifyAdminWithAddedPosts;

class PostsService
{
    public function __construct()
    {
        $this->posts_model = new Post();
        $this->user_model  = new User();
    }

    # LIST ALL POSTS
    public function getPostsWithFilter(FetchPostsWithFilterDTO $FetchPostsWithFilterDTO)
    {
        $size = 10;

        $posts = $this->posts_model

            # USER
            ->when($FetchPostsWithFilterDTO->user_id, function (Builder $query, $value) {
                $query->where("user_id", $value);
            })

            # SEARCH
            ->when($FetchPostsWithFilterDTO->search, function (Builder $query, $value) {
                $query->where(function ($query) use ($value) {
                return $query->where('title', 'LIKE', "%{$value}%")
                            ->orWhere('description', 'LIKE', "%{$value}%");
                    });
            })

            ->orderBy('id', 'desc')
            ->paginate($size);

        return $posts;
    }

    public function viewPostDetails($id)
    {

        $post = $this->posts_model->findOrFail($id);

        return $post;
    }

    public function userPosts($id)
    {
        $size = 10;

        $posts = $this->user_model->findOrFail($id)->posts()
            ->orderBy('id', 'desc')
            ->paginate($size);

        return $posts;
    }

    public function createPost(CreatePostDTO $createPostDTO, $image)
    {
        $image != '' ? $image_path = $image->store('images', 'public') : $image_path = null;


        $data = [
            'title'          => $createPostDTO->title,
            'description'    => $createPostDTO->description,
            'image'          => $image_path,
            'user_id'        => auth('api')->user()->id,
            'phone_number'   => $createPostDTO->phone_number,
        ];
        $post = $this->posts_model->create($data);
       /* if($post){
            event(new NotifyAdminWithAddedPosts($post));
        }*/

        return $post;
    }

}
