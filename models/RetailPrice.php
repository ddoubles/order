<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retail_prices".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $price_date
 * @property int|null $price
 */
class RetailPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'retail_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'price'], 'default', 'value' => null],
            [['product_id', 'price'], 'integer'],
            [['price_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price_date' => 'Price Date',
            'price' => 'Price',
        ];
    }
}
