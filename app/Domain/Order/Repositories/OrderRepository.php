<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 12:13 PM
 */

namespace App\Domain\Order\Repositories;

use App\Domain\Order\Exception\OrderAlreadyBeenTakenException;
use App\Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Domain\Order\Repositories
 */
class OrderRepository extends BaseRepository
{

    /**
     * @return string
     */
    function model()
    {
        return Order::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return "App\\Domain\\Order\\Presenters\\OrderPresenter";
    }


    /**
     * Place order action
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        $this->skipPresenter(false);

        return parent::create($inputs);
    }

    /**
     * Take order action
     *
     * @param array $inputs
     * @param $id
     * @return mixed
     */
    public function update(array $inputs,$id)
    {
        //Check if Order was already taken
        $this->checkOrder($id);

        $this->skipPresenter(false);
        return parent::update($inputs, $id);
    }

    /**
     * Check if order has already been taken
     *
     * @param $id
     * @throws OrderAlreadyBeenTakenException
     */
    public function checkOrder(int $id)
    {

        $order = $this->skipPresenter()->find($id);

        if($order->status == "TAKEN"){
            throw new OrderAlreadyBeenTakenException();
        }
    }
    
}