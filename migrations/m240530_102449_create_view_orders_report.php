<?php

use yii\db\Migration;

/**
 * Class m240530_102449_create_view_orders_report
 */
class m240530_102449_create_view_orders_report extends Migration
{
    private string $viewName = 'orders_report';

    public function safeUp()
    {
        $db = Yii::$app->db;
        $sql = <<<SQL
SELECT o.created_at as order_date, order_id, counterparty_id, order_status, product_id, price, price_types.price_type_code, quantity, order_sum,
       sum(price*op.quantity) over (partition by order_id) as calculated_sum
FROM order_product op
         join orders o on o.id = op.order_id
         join price_types on price_type_id = price_types.id

SQL;
        $sqlCommand = $db->queryBuilder->createView($this->viewName, $sql);
        $db->createCommand($sqlCommand)->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $db = Yii::$app->db;
        $db->createCommand(Yii::$app->db->queryBuilder->dropView($this->viewName))
            ->execute();
    }

}
