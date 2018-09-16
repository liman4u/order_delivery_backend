<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 16/09/2018
 * Time: 7:54 AM
 */

namespace Test;

use App\Domain\Order\Models\Order;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Log;

class OrderDeliveryTest extends \TestCase
{

    use DatabaseTransactions;

    public function testCanPlaceOrder()
    {
        $order = factory(Order::class)->make()->toArray();

        $response = $this->post('/api/v1/order',$order);


        $response
            ->receiveJson()
            ->seeStatusCode(Response::HTTP_CREATED);
    }

}