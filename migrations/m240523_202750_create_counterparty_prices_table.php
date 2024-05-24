<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%counterparty_prices}}`.
 */
class m240523_202750_create_counterparty_prices_table extends Migration
{
    private string $tableName = 'counterparty_prices';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'price_date' => $this->date()->notNull(),
            'price' => $this->integer(20)->notNull(),
            'counterparty_id' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex(
            'counterparty_prices_productid_pricedate_counterpatryid_idx',
            $this->tableName,
            ['product_id', 'price_date', 'counterparty_id']
        );

        $this->addForeignKey($this->tableName . '_product_id_fkey', $this->tableName, 'product_id', 'products', 'id');
        $this->addForeignKey($this->tableName . '_counterparty_id_fkey', $this->tableName, 'counterparty_id', 'counterparties', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->tableName . '_counterparty_id_fkey', $this->tableName);
        $this->dropForeignKey($this->tableName . '_product_id_fkey', $this->tableName);
        $this->dropIndex('counterparty_prices_productid_pricedate_counterpatryid_idx', $this->tableName);
        $this->dropTable('{{%counterparty_prices}}');
    }
}
