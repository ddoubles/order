<?php

namespace app\controllers\api;

use app\models\Order;
use app\services\order\OrderCreatorService;
use Exception;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

class OrdersController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];
        return $behaviors;
    }

    protected function verbs(): array
    {
        return ['create' => ['POST']];
    }

    /**
     * Создание заказа на основании контрагента, даты заказа, и списка товаров.
     * @return Order
     * @throws Exception
     */
    public function actionCreate(): Order
    {
        $orderCreatorService = Yii::$container->get(OrderCreatorService::class);
        $request = Yii::$app->request;
        return $orderCreatorService->create(
            $request->post('counterpartyId'),
            $request->post('orderDate'),
            $request->post('productsIds')
        );
    }

}