<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 12:34 PM
 */

namespace App\Context\Api\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Trait ResponseTrait
 * @package App\Context\Api\Http\Traits
 */
trait ResponseTrait
{
    /**
     * Status code of response
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_OK;


    /**
     * Send success response with Data
     *
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data) {
        $response = [$data];
        return response()->json($response, $this->statusCode);
    }

    /**
     * Send failure response with Message
     *
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function failureResponse($message,$statusCode = Response::HTTP_INTERNAL_SERVER_ERROR) {
        $response = [
            'error' => $message,
        ];
        return response()->json($response, $statusCode);
    }


    /**
     * Return single item response from the application
     *
     * @param Model $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithItem($item,$statusCode = Response::HTTP_CREATED)
    {
        return response()->json($item['data'], $statusCode);
    }
    /**
     * Return a json response from the application
     *
     * @param array $array
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithArray(array $array)
    {
        return response()->json($array['data'], $this->statusCode);
    }


    /**
     * Return json response with validation errors
     *
     * @param Request $request
     * @param array $errors
     * @return array
     */
    protected function buildFailedValidationResponse(Request $request, array $errors) {
        return response()->json(['errors'=> $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}