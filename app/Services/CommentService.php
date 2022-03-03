<?php

namespace  App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Comment;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Interfaces\CommentRepositoryInterface;

class CommentService {


    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    /**
     * Instantiate a new controller instance.
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function all()
    {
        return $this->commentRepository->getAllComments();

    }


    /**
     * Instantiate a new controller instance.
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function create(Request $request)
    {
        if($request->parent_id){
            $parentComment = Comment::find($request->parent_id);
            $parentComment->touch();
        }

        return $this->commentRepository->createComment($request->all());

    }



    /**
     * Instantiate a new controller instance.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @param  int  $id
     * @return void
     */
    public function update(Request $request,$id,User $user)
    {

    }


    /**
     * Instantiate a new controller instance.
     * @param  int  $id
     * @return void
     */
    public function delete($id,User $user)
    {
        //return $this->commentRepository->deleteComment($id);
    }



}
