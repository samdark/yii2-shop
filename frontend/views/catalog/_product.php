<?php
use yii\helpers\Html;
?>
<?php /** @var $product \common\models\Product */ ?>
<div class="col-xs-4">
    <div class="col-xs-12">
        <h2><?= Html::encode($product->title) ?></h2>
    </div>
    <div class="col-xs-8 description">
        <?= Yii::$app->formatter->asNtext($product->description) ?>
    </div>

    <div class="col-xs-4 price">$<?= $product->price ?></div>

    <div class="col-xs-12">
        <?= Html::a('Add to cart', ['cart/add', 'id' => $product->id], ['class' => 'btn btn-success'])?>
    </div>
</div>