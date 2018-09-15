<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 12:21 PM
 */

namespace App\Domain\Order\Exception;

/**
 * Class OrderAlreadyBeenTakenException
 * @package App\Domain\Order\Exception
 */
class OrderAlreadyBeenTakenException extends \Exception
{

     protected $message = "ORDER_ALREADY_BEEN_TAKEN";

}