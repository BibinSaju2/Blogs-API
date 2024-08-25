<?php

namespace App\Repositories;

use App\Models\Post;

use App\Interfaces\PostRepositoryInterface;
use App\Http\Resources\PostResource;

class PostRepository implements PostRepositoryInterface
{
    

    public function getAll(){
        return Post::all();

    }
    public function create(array $data)
    {   
        if (isset($data['tags']) && is_array($data['tags'])) {
           $data['tags'] = implode(',', $data['tags']);
        }
        $post = Post::create($data);
        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }

    public function update(array $data)
    {   
        if (isset($data['tags']) && is_array($data['tags'])) {
          $data['tags'] = implode(',', $data['tags']);
        }
        return Post::FindorFail($data['post_id'])->update($data);
    }

    public function delete($id)
    {
        return Post::destroy($id);
    }
}
