<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
   
    public function index()
    { 
        $comments = $this->commentRepository->getAll();
        return response()->json([
            'comments' => $comments
        ], 200);
    }

    public function create(CreateCommentRequest $request)
    {   
       
        $data = $request->only(['content','post_id']);
        $data['user_id'] = Auth::user()->id;
        $comment = $this->commentRepository->create($data);
        if($comment)
        {
            return response()->json([
                'comment' => $comment,
                'message' => 'Post Created Successfully',
            ], 201);
        }

        return response()->json(['message' => 'Something went wrong'], 500);
    }

    public function show($id)
    {
        $comment = $this->commentRepository->show($id);
        return response()->json([
            'comment' => $comment
        ], 200);
    }

    public function update(UpdateCommentRequest $request)
    {
        $data = $request->only(['post_id','content', 'comment_id']);
        $data['user_id'] = Auth::user()->id;
        $post = $this->commentRepository->update($data);
        if($post)
        {
            return response()->json([
                'post' => $post,
                'message' => 'Post Updated Successfully',
            ], 201);
        }

        return response()->json(['message' => 'Something went wrong'], 500);
    }

    public function delete($id)
    {
        $this->commentRepository->delete($id);
        return response()->json([
            'message' => "Comment Deleted Successfully"
        ], 200);
    }
}
