<?php

namespace api\models;

use common\helpers\PriceHelper;
use common\models\Order;
use common\models\OrderItem;
use common\models\Product;
use common\models\ProductVariant;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class OrderForm extends Order
{
    private $_user;
    private $_order_items = [];

    public $name;
    public $address;
    public $email;
    public $phone;
    public $notes;
    public $order_items;

    const DELIVERY_CITY = 'Pale';
    const DELIVERY_COUNTRY = 'BA';

    public function rules()
    {
        return [
            [['name', 'address', 'email', 'phone', 'notes', 'order_items'], 'safe'],
            [['address', 'email', 'phone', 'notes'], 'filter', 'filter' => 'trim'],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->validateOrderItems()) {
            return false;
        }

        if (!$this->populateOrderItems()) {
            return false;
        }

        $this->populateOrder();

        if (!$this->user_id) {
            if (!$this->createGuestUser()) {
                $transaction->rollBack();
                return false;
            }
        }

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveOrderItems()) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }

    private function validateOrderItems()
    {
        foreach ($this->order_items as $item) {
            if (!$this->validateOrderItem($item)) {
                return false;
            }
        }
        return true;
    }

    private function validateOrderItem($item)
    {
        if ((!isset($item['product_id']) && !isset($item['product_variant_id'])) || !isset($item['quantity'])) {
            $this->addError('order_item', 'Order item invalid body !');
            return false;
        }

        if ($item['quantity'] < 1) {
            $this->addError('order_items', 'Order item quantity must be greater then 0 !');
            return false;
        }

        return true;
    }

    private function populateOrderItems()
    {
        foreach ($this->order_items as $item) {
            if (!$this->populateOrderItem($item)) {
                return false;
            }
        }
        return true;
    }

    private function populateOrderItem($item){
        $price = 0;
        $quantity = $item['quantity'];
        $productId = null;

        if (!empty($item['product_variant_id'])) {
            $model = ProductVariant::findOne($item['product_variant_id']);

            if (empty($model)) {
                $this->addError('order_items', 'Product variant is missing !');
                return false;
            }

            $productId = $model->product_id;
            $price = $model->price ?: $model->product->price;
        } elseif (!empty($item['product_id'])) {
            $model = Product::findOne($item['product_id']);

            if (empty($model)) {
                $this->addError('order_items', 'Product is missing !');
                return false;
            }
            $productId = $model->id;
            $price = $model->price;
        }

        $this->_order_items[] = [
            'product_id' => $productId,
            'product_variant_id' => $item['product_variant_id'],
            'quantity' => $item['quantity'],
            'price' => $price,
            'total' => $item['quantity'] * $price,
        ];

        return true;
    }

    private function populateOrder()
    {
        $request = Yii::$app->getRequest();

        $total = $this->calculateTotal();
        $tax = PriceHelper::extractTax($total);
        $subtotal = $total - $tax;

        $this->_user = Yii::$app->user->identity ?: User::findByUsernameOrEmail($this->email);

        $nameArray = explode(' ', preg_replace('/\s+/', ' ', trim($this->name)));
        $deliveryFirstName = array_shift($nameArray);
        $deliveryLastName = implode(' ', $nameArray);

        $this->setAttributes([
            'user_id' => ArrayHelper::getValue($this->_user, 'id'),
            'code' => self::ORDER_NUMBER_PREFIX . $this->getNextId(),
            'delivery_first_name' => $deliveryFirstName,
            'delivery_last_name' => $deliveryLastName,
            'delivery_phone' => $this->phone,
            'delivery_address' => $this->address,
            'delivery_city' => self::DELIVERY_CITY,
            'delivery_country' => self::DELIVERY_COUNTRY,
            'delivery_notes' => $this->notes,
            'request' => Json::encode($request->getBodyParams()),
            'customer_ip_address' => $request->getUserIP(),
            'customer_user_agent' => $request->getUserAgent(),
            'currency' => Yii::$app->params['currency'],
            'status' => self::STATUS_PENDING,
            'total' => $total,
            'total_tax' => $tax,
            'subtotal' => $subtotal,
        ], false);
    }

    private function calculateTotal()
    {
        return array_sum(
            array_map(function ($item) {
                return $item['total'];
            }, $this->_order_items)
        );
    }

    private function createGuestUser()
    {
        $model = new User([
            'username' => $this->email,
            'email' => $this->email,
            'status' => User::STATUS_INACTIVE,
            'first_name' => $this->delivery_first_name ?: ' ',
            'last_name' => $this->delivery_last_name ?: ' ',
            'address' => $this->address,
            'country' => self::DELIVERY_COUNTRY,
            'city' => self::DELIVERY_CITY,
            'phone' => $this->phone
        ]);

        if (!$model->save()) {
            $this->addError('user', $model->getFirstErrors());
            return false;
        }

        $this->user_id = $model->id;

        return true;
    }

    private function saveOrderItems()
    {
        foreach ($this->_order_items as $item) {
            $model = new OrderItem([
                'order_id' => $this->id,
                'product_id' => $item['product_id'],
                'product_variant_id' => $item['product_variant_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['total'],
            ]);

            if (!$model->save()) {
                $this->addError('order_item', $model->getFirstErrors());
                return false;
            }
        }

        return true;
    }
}