<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_product`.
 */
class m240523_203317_create_order_product_table extends Migration
{
    private string $tableName = 'order_product';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'price' => $this->integer(20)->notNull(),
            'quantity' => $this->integer(10)->notNull(),
            'price_id' => $this->integer(11)->notNull(),
            'price_type_id' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex('order_product_order_id_product_id_idx', $this->tableName, ['order_id', 'product_id'], true);

        $this->addForeignKey($this->tableName . '_order_id_fkey', $this->tableName, 'order_id', 'orders', 'id');
        $this->addForeignKey($this->tableName . '_product_id_fkey', $this->tableName, 'product_id', 'products', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->tableName . '_order_id_fkey', $this->tableName);
        $this->dropForeignKey($this->tableName . '_product_id_fkey', $this->tableName);
        $this->dropIndex('order_product_order_id_product_id_idx', $this->tableName);
        $this->dropTable('{{%order_product}}');
    }
}
