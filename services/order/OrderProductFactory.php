<?php

namespace app\services\order;

use app\models\OrderProduct;

class OrderProductFactory
{
    public function create(array $attributes): OrderProduct
    {
        return new OrderProduct($attributes);
    }

}