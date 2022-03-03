<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getAllComments();
    public function deleteComment($commentId);
    public function createComment(array $commentDetails);

}
