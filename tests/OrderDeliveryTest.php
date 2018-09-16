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


class OrderDeliveryTest extends \TestCase
{

    use DatabaseTransactions;

    /**
     * Test for can place order
     */
    public function testCanPlaceOrder()
    {
        $order = factory(Order::class)->make()->toArray();


        $response = $this->post('/api/v1/order',$order);


        $response
            ->receiveJson()
            ->seeStatusCode(Response::HTTP_CREATED)
            ->seeJsonStructure(
                    [
                        'id',
                        'distance',
                        'status'
                    ]

            );
    }

    /**
     * Test for can not place order with empty input
     */
    public function testCanNotPlaceOrderWithEmptyInput()
    {

        $response = $this->post('/api/v1/order',[]);


        $response
            ->receiveJson()
            ->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonStructure([
                'errors' =>
                    [
                        'origin',
                        'destination'
                    ]

            ]);
    }


    /**
     * Test for can not place order with empty latitude and longitude
     */
    public function testCanNotPlaceOrderWithEmptyLatitudeLongitude()
    {

        $order = new Order([
            'origin' => [],
            'destination' => []
         ]);

        $response = $this->post('/api/v1/order',$order->toArray());

        $response
            ->receiveJson()
            ->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonStructure([
                'errors' =>
                    [
                        'origin',
                        'destination'
                    ]

            ]);
    }

    /**
     * Test for can not place order with invalid latitude and longitude
     */
    public function testCanNotPlaceOrderWithInvalidLatitudeLongitude()
    {

        $order = new Order([
            'origin' => ['123','123'],
            'destination' => ['123','123']
        ]);

        $response = $this->post('/api/v1/order',$order->toArray());

        $response
            ->receiveJson()
            ->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonStructure([
                'errors' =>
                    [
                        'origin',
                        'destination'
                    ]

            ]);
    }

}