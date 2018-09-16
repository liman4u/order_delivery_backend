<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 12:29 PM
 */

namespace App\Context\Api\Http\Controllers\Order;

use App\Context\Api\Http\Traits\ResponseTrait;
use App\Core\Http\Controllers\Controller;
use App\Domain\Order\Exception\OrderAlreadyBeenTakenException;
use App\Domain\Order\Repositories\OrderRepository;
use App\Domain\Order\Validators\OrderValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Log;

/**
 * Class OrderController
 * @package App\Context\Api\Http\Controllers\Order
 */
class OrderController extends Controller
{
    use ResponseTrait;

    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * OrderController constructor.
     * @param OrderRepository $repository
     */
    public function __construct(OrderRepository $repository){
        $this->repository = $repository;
    }

    /**
     * Display a listing of orders
     *
     * @return Response
     */
    public function index()
    {
        return $this->respondWithArray($this->repository->all());

    }

    /**
     * Place order action
     *
     * @return Response
     */
    public function store(OrderValidator $validator, Request $request)
    {

        $this->validate($request,$validator->getRules(ValidatorInterface::RULE_CREATE));

        try {

            $origin = json_decode($request->input('origin'),true);
            $destination = json_decode($request->input('destination'),true);

            $start_latitude = $origin[0];
            $start_longitude = $origin[1];

            $end_latitude = $destination[0];
            $end_longitude =  $destination[1];

            Log::info("Start Latitude : " . $start_latitude);
            Log::info("Start Longitude : " . $start_longitude);

            Log::info("End Latitude : " . $end_latitude);
            Log::info("End Longitude : " . $end_longitude);

            if($this->isValidLatitude($start_latitude) && $this->isValidLongitude($start_longitude) && $this->isValidLatitude($end_latitude) && $this->isValidLongitude($end_longitude)) {

                $input = array();
                $input['start_latitude'] = $start_latitude;
                $input['start_longitude'] = $start_longitude;

                $input['end_latitude'] = $end_latitude;
                $input['end_longitude'] = $end_longitude;

                //set UNASSIGN as default status
                $input['status'] = "UNASSIGN";

                $input['distance'] = $this->getDistance($start_latitude, $start_longitude, $end_latitude, $end_longitude);


                return $this->respondWithItem($this->repository->store($input));

            }else {

                $response['data'] = ["error"=>"INVALID_PARAMETER(S)"];

                return $this->failureResponse($response);
            }


        } catch (\Exception $exception) {

            return $this->failureResponse($exception->getMessage());


        }

    }


    /**
     *
     * Take order action
     *
     * @param OrderValidator $validator
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderValidator $validator,Request $request,$id)
    {

        $this->validate($request,$validator->getRules(ValidatorInterface::RULE_UPDATE));

        try{

            $input = array();
            $input['status'] = strtoupper($request->input('status'));

            $this->repository->update($input,$id);

            $response['data'] = ["status"=>"SUCCESS"];

            return $this->respondWithItem($response);

        } catch (\Exception $exception) {

            return $this->failureResponse($exception->getMessage());


        }

    }


    /**
     * Get distance from google distance matrix API
     *
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return int
     */
    public function getDistance($start_latitude,$start_longitude,$end_latitude,$end_longitude)
    {
        $api_key = env('API_KEY');

        $origins = $start_latitude.",".$start_longitude;

        $destinations = $end_latitude.",".$end_longitude;

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origins . "&destinations=" . $destinations . "&language=en-EN&key=".$api_key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);


        if (isset($response_a['rows'][0]['elements'][0]['distance']['text'])) {
            $distance = $response_a['rows'][0]['elements'][0]['distance']['text'];
        }else{
            $distance = 0;
        }

        Log::info("Distance retrieved : ".$distance);


        return $distance;
    }

    public function isValidLatitude($latitude)
    {

        if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $latitude)) {
            return true;
        } else {
            return false;
        }

    }

    public function isValidLongitude($longitude)
    {
        if(preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/",
            $longitude)) {
            return true;
        } else {
            return false;
        }
    }

}