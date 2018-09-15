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
use App\Domain\Order\Repositories\OrderRepository;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->respondWithArray($this->repository->all());

    }

}