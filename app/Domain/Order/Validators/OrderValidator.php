<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 11:59 AM
 */

namespace App\Domain\Order\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class OrderValidator
 * @package App\Domain\Order\Validators
 */
class OrderValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'origin.*' => 'required | regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
            'destination.*' => 'required | regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
         ]
    ];

}