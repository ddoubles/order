<?php

namespace app\models;

use yii\base\Model;

class OrderForm extends Model
{
    public $counterpartyId;
    public $orderDate;
    public $productsIds;

    public function rules()
    {
        return [
            [['counterpartyId', 'orderDate', 'productsIds'], 'required'],
            ['counterpartyId', 'integer'],
            ['orderDate', 'date'],
            ['productsIds', 'each', 'rule' => ['integer']]
        ];
    }

}