<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;


abstract class ApiController extends Controller
{

    /**
     * Returns a generic success (200) JSON response.
     *
     * @param  string $message
     * @return JsonResponse
     */
    public function responseSuccess($data=[], $message = '',$success = true )
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
        ], 200);
    }

    /**
     * Returns a resource updated success message (200) JSON response.
     *
     * @param  string $message
     * @return JsonResponse
     */
    public function responseResourceUpdated($data=[], $message = '',$success = true )
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
        ], 200);
    }

    /**
     * Returns a resource created (201) JSON response.
     *
     * @param  string $message
     * @return JsonResponse
     */
    public function responseResourceCreated($data=[], $message = '',$success = true )
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
        ], 201);
    }

    /**
     * Returns a resource deleted (204) JSON response.
     *
     * @param  string $message
     * @return JsonResponse
     */
    public function responseResourceDeleted($message = 'Resource deleted.', $success = true, $data=[])
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
        ], 204);
    }

    /**
     * Returns an unauthorized (401) JSON response.
     *
     * @param  array $errors
     * @return JsonResponse
     */
    public function responseUnauthorized($error = 'Not Authorized For This Action', $success = false,  $data=[])
    {

        return response()->json([
             'success' => $success,
             'data' => $data,
             'error' => $error,
        ], 401);
    }

    /**
     * Returns a unprocessable entity (422) JSON response.
     *
     * @param  array $errors
     * @return JsonResponse
     */
    public function responseUnprocessable($error = 'There is some errors' ,$success = false, $data=[])
    {

        return response()->json([
            'success' => $success,
            'data' => $data,
            'error' => $error ,
        ], 422);
    }



    /**
     * Returns a server error (500) JSON response.
     *
     * @param  array $errors
     * @return JsonResponse
     */
    public function responseServerError($error = 'There is a Server Error',$success = false, $data=[])
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'error' => $error,
        ], 500);
    }
}
