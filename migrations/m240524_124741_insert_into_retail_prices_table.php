<?php

use yii\db\Migration;

/**
 * Class m240524_124741_insert_into_retail_prices_table
 */
class m240524_124741_insert_into_retail_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'retail_prices',
            ['product_id', 'price_date', 'price'],
            [
                [1, '2024-05-28', 450],
                [3, '2024-05-28', 650],
                [1, '2024-05-29', 1750],
                [2, '2024-05-28', 1900],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240524_124741_insert_into_retail_prices_table cannot be reverted.\n";

        return false;
    }
}
