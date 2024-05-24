<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%counterparties}}`.
 */
class m240523_202347_create_counterparties_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%counterparties}}', [
            'id' => $this->primaryKey(),
            'counterparty_name' => $this->string(500)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%counterparties}}');
    }
}
