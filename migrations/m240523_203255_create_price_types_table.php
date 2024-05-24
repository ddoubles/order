<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_types`.
 */
class m240523_203255_create_price_types_table extends Migration
{
    private string $tableName = 'price_types';
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'price_type_code' => $this->string(20)->notNull(),
            'price_table_name' => $this->string(100)->notNull(),
        ]);

        $this->createIndex(
            'price_types_price_type_code_idx',
            $this->tableName,
            'price_type_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
