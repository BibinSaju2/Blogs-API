<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(){
        return Comment::all();

    }
    public function create(array $data)
    {   
        $comments = Comment::create($data);
        return new CommentResource($comments);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        return new CommentResource($comment);
    }

    public function update(array $data)
    {   
        return Comment::FindorFail($data['comment_id'])->update($data);
    }

    public function delete($id)
    {
        return Comment::destroy($id);
    }
}
