<?php

use yii\db\Migration;

/**
 * Class m240524_123523_insert_into_price_types_table
 */
class m240524_123523_insert_into_price_types_table extends Migration
{
    private $counterpartyPricesTable = 'counterparty_prices';
    private $retailPricesTable = 'retail_prices';
    private $priceTypesTableName = 'price_types';
    public function safeUp()
    {
        $this->batchInsert($this->priceTypesTableName, ['price_table_name', 'price_type_code'], [
            [$this->counterpartyPricesTable, 'counterparty'],
            [$this->retailPricesTable, 'retail'],
        ]);

    }

    public function safeDown()
    {
        $this->delete($this->priceTypesTableName, ['price_type_code' => ['counterparty', 'retail']]);
    }
}
