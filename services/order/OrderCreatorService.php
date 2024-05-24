<?php

namespace app\services\order;

use app\models\CounterpartyPrice;
use app\models\Order;
use app\models\OrderProduct;
use app\models\PriceType;
use app\models\RetailPrice;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

final readonly class OrderCreatorService
{
    public function __construct(
        private CounterpartyPrice $counterpartyPrice,
        private OrderProductFactory $orderProductFactory,
        private RetailPrice $retailPrice,
        private PriceType $priceType,
        private Order $order,
    ) {}

    /**
     * @param int $counterpartyId
     * @param string $orderDate
     * @param array $products Массив вида: [['id' => 1, 'quantity' => 4],...]
     * @return array
     * @throws Exception
     */
    public function create(int $counterpartyId, string $orderDate, array $products): array
    {
        $prices = $this->findProductsPrices($counterpartyId, $orderDate, $products);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->order->counterparty_id = $counterpartyId;
            $this->order->order_sum = 1;
            $this->order->order_status = $this->order::ORDER_CREATING_STATUS;
            $this->order->save(false);
            $orderProducts = [];
            $priceTypeMap = $this->priceType::getTableNameIdMapped();
            foreach ($products as $product) {
                // Формируем товар в заказе только если получили цену товара
                if (array_key_exists($product['id'], $prices)) {
                    /** @var RetailPrice|CounterpartyPrice $price */
                    $price = $prices[$product['id']];
                    $orderProduct = $this->orderProductFactory->create([
                        'order_id' => $this->order->id,
                        'product_id' => $product['id'],
                        'price' => $price->price,
                        'quantity' => $product['quantity'],
                        'price_id' => $price->id,
                        'price_type_id' => $priceTypeMap[$price::tableName()],
                    ]);
                    $orderProduct->save(false);
                    $orderProducts[] = $orderProduct;
                }
            }
            $this->order->order_sum = $this->calculateSum($orderProducts);
            $this->order->order_status = $this->order::ORDER_NEW_STATUS;
            $this->order->save();
        } catch (\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
        $transaction->commit();

        return $prices;
    }

    /**
     * @param OrderProduct[] $productsPrices
     * @return int
     */
    private function calculateSum(array $productsPrices): int
    {
        $sum = 0;
        foreach ($productsPrices as $productsPrice) {
            $sum += $productsPrice->price * $productsPrice->quantity;
        }
        return $sum;
    }

    /**
     * Поиск цены в таблице цен контрагентов,
     * если найдены не всё - ищем в retail недостающие
     * @param int $counterpartyId
     * @param string $priceDate
     * @param array $products
     * @return array
     */
    private function findProductsPrices(int $counterpartyId, string $priceDate, array $products): array
    {
        $productsIds = ArrayHelper::getColumn($products, 'id');
        $counterpartyPrices = $this->findCounterpartyPrices($counterpartyId, $priceDate, $productsIds);
        $counterpartyPricesProductsIds = ArrayHelper::getColumn($counterpartyPrices, 'product_id');
        /** @var int[] $counterpartyPricesProductsIdsDiff Id[] не найденных товаров в ценах контрагентов */
        $counterpartyPricesProductsIdsDiff = array_diff($productsIds, $counterpartyPricesProductsIds);
        $retailPrices = [];
        if ($counterpartyPricesProductsIdsDiff) {
            $retailPrices = $this->findRetailPrices($priceDate, $counterpartyPricesProductsIdsDiff);
        }

        return ArrayHelper::index(array_merge($counterpartyPrices, $retailPrices), 'product_id');
    }

    private function findCounterpartyPrices(int $counterpartyId, string $priceDate, array $productsIds): array
    {
        return $this->counterpartyPrice->find()
            ->where([
                'counterparty_id' => $counterpartyId,
                'product_id' => $productsIds,
                'price_date' => $priceDate,
            ])
            ->all();
    }

    private function findRetailPrices(string $priceDate, array $productsIds): array
    {
        return $this->retailPrice->find()
            ->where([
                'product_id' => $productsIds,
                'price_date' => $priceDate,
            ])
            ->all();
    }

}