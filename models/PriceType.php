<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "price_types".
 *
 * @property int $id
 * @property string|null $price_type_code
 * @property string|null $price_table_name
 */
class PriceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'price_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['price_type_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'price_type_code' => 'Price Type Code',
        ];
    }

    public static function getTableNameIdMapped(): array
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'price_table_name', 'id');
    }
}
