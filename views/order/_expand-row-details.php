<?php

use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
/** @var yii\web\View $this */
/** @var \app\models\OrderProduct[] $models */

?>
<div>

    <?php

    $provider = new ArrayDataProvider([
        'allModels' => $models,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['id', 'name'],
        ],
    ]);

    ?>
    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'id',
            'order_id',
            'product_id',
            'price',
            'quantity',
            'price_id',
            [
                'attribute' => 'price_type',
                'value' => function ($model) {
                    return $model->priceType->price_table_name;
                }
            ],
        ],
    ]); ?>

</div>
