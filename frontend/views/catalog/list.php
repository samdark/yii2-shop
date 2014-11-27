<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$title = $category === null ? 'Welcome!' : $category->title;
$this->title = Html::encode($title);
?>

<h1><?= Html::encode($title) ?></h1>

<div class="container-fluid">
    <div class="col-xs-4">
        <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= Html::a(Html::encode($category->title), ['catalog/list', 'id' => $category->id])?></li>
        <?php endforeach ?>
        </ul>
    </div>

    <div class="col-xs-8">
        <div class="row">
        <?php foreach ($products as $product): ?>
            <?= $this->render('_product', ['product' => $product]) ?>
        <?php endforeach ?>
        </div>

    </div>
</div>