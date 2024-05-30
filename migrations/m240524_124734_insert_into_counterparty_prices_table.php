<?php

use yii\db\Migration;

/**
 * Class m240524_124734_insert_into_counterparties_prices_table
 */
class m240524_124734_insert_into_counterparty_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'counterparty_prices',
            ['product_id', 'price_date', 'price', 'counterparty_id'],
            [
                [1, '2024-01-21', 2000, 1],
                [2, '2024-05-01', 3000, 2],
                [2, '2024-03-01', 5000, 2],
                [3, '2024-04-01', 4000, 3],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240524_124734_insert_into_counterparties_prices_table cannot be reverted.\n";

        return false;
    }
}
