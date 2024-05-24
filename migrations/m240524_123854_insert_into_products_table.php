<?php

use yii\db\Migration;

/**
 * Class m240524_123854_insert_into_products_table
 */
class m240524_123854_insert_into_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('products', ['product_name'], [
            ['Car'],
            ['Balloon'],
            ['Gears']
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240524_123854_insert_into_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240524_123854_insert_into_products_table cannot be reverted.\n";

        return false;
    }
    */
}
