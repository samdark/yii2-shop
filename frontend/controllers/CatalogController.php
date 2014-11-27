<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;

class CatalogController extends \yii\web\Controller
{
    public function actionList($id = null)
    {
        /** @var Product[] $products */
        $products = [];

        /** @var Category $category */
        $category = null;


        if ($id !== null) {
            $category = Category::findOne($id);
            $categories = $category->categories;
            $products = Product::findAll(['category_id' => $id]);
        } else {
            $categories = Category::find()->all();
        }

        return $this->render('list', [
            'category' => $category,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
