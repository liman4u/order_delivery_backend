<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 11:55 AM
 */

namespace App\Domain\Order\Presenters;

use App\Domain\Order\Transformers\OrderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderPresenter
 * @package App\Domain\Order\Presenters
 */
class OrderPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderTransformer();
    }


}