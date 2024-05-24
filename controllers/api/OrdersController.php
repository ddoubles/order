<?php

namespace app\controllers\api;

use app\services\order\OrderCreatorService;
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

    protected function verbs()
    {
        return ['create' => ['POST']];
    }

    /**
     * Создание заказа на основании контрагента, даты заказа, и списка товаров.
     * @return void
     */
    public function actionCreate()
    {
        $orderCreatorService = Yii::$container->get(OrderCreatorService::class);
        $request = Yii::$app->request;
        $prices = $orderCreatorService->create(
            $request->post('counterpartyId'),
            $request->post('orderDate'),
            $request->post('productsIds'))
        ;
        $this->asJson($prices);
    }

}