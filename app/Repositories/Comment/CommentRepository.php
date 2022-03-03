<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAllComments()
    {
        return Comment::where('status', 1)
        ->with('replies')
        ->with('sub_replies')
        ->orderBy('updated_at', 'desc')
        ->get();
    }

    public function deleteComment($commentId)
    {
        Comment::destroy($commentId);
    }

    public function createComment(array $commentDetails)
    {
        return Comment::create($commentDetails);
    }


}
