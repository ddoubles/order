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
            ['Хорошая компания'],
            ['Отличная компания'],
            ['Нормальная компания'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('counterparties', ['counterparty_name' => [
            'Хорошая компания',
            'Отличная компания',
            'Нормальная компания',
        ]]);
    }
}
