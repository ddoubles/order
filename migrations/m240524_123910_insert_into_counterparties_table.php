<?php

use yii\db\Migration;

/**
 * Class m240524_123910_insert_into_counterparties_table
 */
class m240524_123910_insert_into_counterparties_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('counterparties', ['counterparty_name'], [
            ['Creative Cultures'],
            ['Mega electronics'],
            ['Omega Corp'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240524_123910_insert_into_counterparties_table cannot be reverted.\n";

        return false;
    }
}
