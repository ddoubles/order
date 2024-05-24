<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m240523_203026_create_orders_table extends Migration
{
    private string $tableName = 'orders';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'counterparty_id' => $this->integer(11)->notNull(),
            'order_sum' => $this->integer(20)->notNull(),
            'order_status' => $this->string(50)->notNull(),
        ]);

        $this->createIndex('orders_created_at_idx', $this->tableName, 'created_at');
        $this->addForeignKey($this->tableName . '_counterparty_id_fkey', $this->tableName, 'counterparty_id', 'counterparties', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->tableName . '_counterparty_id_fkey', $this->tableName);
        $this->dropIndex('orders_created_at_idx', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
