<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%retail_prices}}`.
 */
class m240523_202453_create_retail_prices_table extends Migration
{
    private string $tableName = 'retail_prices';
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
        ]);

        $this->createIndex(
            'retail_prices_productid_pricedate_idx',
            $this->tableName,
            ['product_id', 'price_date']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('retail_prices_productid_pricedate_idx', $this->tableName);
        $this->dropTable('{{%retail_prices}}');
    }
}
