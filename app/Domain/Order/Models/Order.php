<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 11:40 AM
 */

namespace App\Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Domain\Order\Models
 */
class Order extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'start_latitude',
        'start_longitude',
        'end_latitude',
        'end_longitude',
        'distance',
        'status'
    ];

    /**
     * Prevents insertion with id
     *
     * @var array
     */
    protected $guarded = ['id'];


}