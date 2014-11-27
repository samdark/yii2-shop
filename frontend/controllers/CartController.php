<?php

namespace frontend\controllers;

use common\models\Product;

class CartController extends \yii\web\Controller
{
    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            
        }
    }

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionRemove()
    {
        return $this->render('remove');
    }

}
