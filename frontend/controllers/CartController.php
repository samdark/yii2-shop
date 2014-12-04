<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\OrderItem;
use common\models\Product;
use yz\shoppingcart\ShoppingCart;

class CartController extends \yii\web\Controller
{
    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->put($product);
            return $this->goBack();
        }
    }

    public function actionList()
    {
        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        $products = $cart->getPositions();
        $total = $cart->getCost();

        return $this->render('list', [
           'products' => $products,
           'total' => $total,
        ]);
    }

    public function actionRemove($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->remove($product);
            $this->redirect(['cart/list']);
        }
    }

    public function actionUpdate($id, $quantity)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->update($product, $quantity);
            $this->redirect(['cart/list']);
        }
    }

    public function actionOrder()
    {
        $order = new Order();

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        $total = $cart->getCost();

        if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach($products as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->title = $product->title;
                $orderItem->price = $product->getPrice();
                $orderItem->product_id = $product->id;
                $orderItem->quantity = $product->getQuantity();
                if (!$orderItem->save(false)) {
                    $transaction->rollBack();
                    \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
                    return $this->redirect('catalog/list');
                }
            }

            $transaction->commit();
            \Yii::$app->cart->removeAll();

            \Yii::$app->session->addFlash('success', 'Thanks for your order. We\'ll contact you soon.');
            $order->sendEmail();

            return $this->redirect('catalog/list');
        }

        return $this->render('order', [
            'order' => $order,
            'products' => $products,
            'total' => $total,
        ]);
    }
}
