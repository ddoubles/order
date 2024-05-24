<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "counterparty_prices".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $price_date
 * @property int|null $price
 * @property int|null $counterparty_id
 *
 * @property Counterparty $counterparty
 * @property Product $product
 */
class CounterpartyPrice extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counterparty_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'price', 'counterparty_id'], 'default', 'value' => null],
            [['product_id', 'price', 'counterparty_id'], 'integer'],
            [['price_date'], 'safe'],
            [['counterparty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Counterparty::class, 'targetAttribute' => ['counterparty_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
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
            'counterparty_id' => 'Counterparty ID',
        ];
    }

    /**
     * Gets query for [[Counterparty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCounterparty()
    {
        return $this->hasOne(Counterparty::class, ['id' => 'counterparty_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
