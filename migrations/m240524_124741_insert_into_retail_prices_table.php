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
                [1, '2024-01-01', 1000],
                [4, '2024-02-01', 2000],
                [2, '2024-03-01', 1500],
                [1, '2024-04-01', 8000],
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
