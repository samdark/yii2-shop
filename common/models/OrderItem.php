<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $title
 * @property string $price
 * @property integer $product_id
 * @property double $quantity
 *
 * @property Product $product
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'title' => 'Title',
            'price' => 'Price',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
