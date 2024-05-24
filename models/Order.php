<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string|null $created_at
 * @property int|null $counterparty_id
 * @property int|null $order_sum
 * @property string|null $order_status
 *
 * @property Counterparty $counterparty
 * @property OrderProduct $orderProduct
 */
class Order extends \yii\db\ActiveRecord
{
    const ORDER_CREATING_STATUS = 'creating';
    const ORDER_NEW_STATUS = 'new';
    const ORDER_COMPLETED_STATUS = 'completed';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['counterparty_id', 'order_sum'], 'default', 'value' => null],
            [['counterparty_id', 'order_sum'], 'integer'],
            [['order_status'], 'string', 'max' => 50],
            [['counterparty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Counterparty::class, 'targetAttribute' => ['counterparty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'counterparty_id' => 'Counterparty ID',
            'order_sum' => 'Order Sum',
            'order_status' => 'Order Status',
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
     * Gets query for [[OrderProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }
}
