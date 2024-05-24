<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counterparties".
 *
 * @property int $id
 * @property string|null $counterparty_name
 *
 * @property CounterpartyPrice[] $counterpartyPrices
 * @property Order[] $orders
 */
class Counterparty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counterparties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['counterparty_name'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'counterparty_name' => 'Counterparty Name',
        ];
    }

    /**
     * Gets query for [[CounterpartyPrices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCounterpartyPrices()
    {
        return $this->hasMany(CounterpartyPrice::class, ['counterparty_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['counterparty_id' => 'id']);
    }
}
