<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{   
    
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $posts = $this->postRepository->getAll();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function create(CreatePostRequest $request)
    {   
       
        $data = $request->only(['title','tags','content','user_id']);
        $data['user_id'] = Auth::user()->id;
        $post = $this->postRepository->create($data);
        if($post)
        {
            return response()->json([
                'post' => $post,
                'message' => 'Post Created Successfully',
            ], 201);
        }

        return response()->json(['message' => 'Something went wrong'], 500);
    }

    public function update(UpdatePostRequest $request)
    {
        $data = $request->only(['title','tags','content','user_id','post_id']);
        $data['user_id'] = Auth::user()->id;
        $post = $this->postRepository->update($data);
        if($post)
        {
            return response()->json([
                'post' => $post,
                'message' => 'Post Updated Successfully',
            ], 201);
        }

        return response()->json(['message' => 'Something went wrong'], 500);
    }

    public function show($id)
    {
        $post = $this->postRepository->show($id);
        return response()->json([
            'post' => $post
        ], 200);
    }

    public function delete($id)
    {
        $this->postRepository->delete($id);
        return response()->json([
            'message' => "Post Deleted Successfully"
        ], 200);
    }
}
