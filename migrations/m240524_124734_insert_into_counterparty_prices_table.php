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
                [1, '2024-05-28', 150, 1],
                [1, '2024-05-28', 350, 2],
                [1, '2024-05-29', 450, 2],
                [2, '2024-05-28', 550, 2],
                [3, '2024-05-30', 590, 1],
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
