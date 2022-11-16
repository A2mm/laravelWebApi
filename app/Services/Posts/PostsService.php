<?php

namespace App\Services\Posts;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\DTOs\Posts\{FetchPostsWithFilterDTO, CreatePostDTO};
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostsService
{
    public function __construct()
    {
        $this->posts_model = new Post();
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

    public function createPost(CreatePostDTO $createPostDTO)
    {
        $data = [
            'title'          => $createPostDTO->title,
            'description'    => $createPostDTO->description,
            'image'          => $createPostDTO->image,
            'phone_number'   => $createPostDTO->phone_number,
        ];
        $post = $this->posts_model->create($data);

        return $post;
    }

}
