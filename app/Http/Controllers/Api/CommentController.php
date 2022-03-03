<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;



class CommentController extends ApiController
{

    protected $CommentService;
    protected $user;


    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(CommentService $CommentService)
    {
        $this->CommentService = $CommentService;
    }



  public function index(Request $request)
  {

    return $this->responseSuccess($this->CommentService->all());
  }

  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:16',
        'comment' => 'required|max:160'
      ]);

      if ($validator->fails()) {
        return $this->responseUnprocessable($validator->errors());
      }


    return $this->responseResourceCreated($this->CommentService->create($request));

  }



}
