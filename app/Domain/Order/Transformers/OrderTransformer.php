<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 11:52 AM
 */

namespace App\Domain\Order\Transformers;

use App\Domain\Order\Models\Order;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderTransformer
 * @package App\Domain\Order\Transformers
 */
class OrderTransformer extends TransformerAbstract
{

    public function transform(Order $order)
    {
        return [
            'id'      => (int) $order->id,
            'distance'   => $order->distance,
            'status' =>  $order->status
        ];
    }

}