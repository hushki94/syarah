<?php

/** @var common\models\Product $model */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="card h-100">
    <!-- Sale badge-->
    <?= Html::a('view', Url::to(['/site/view', 'id' => $model->id])) ?>
    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo $model->category->title ?></div>
    <!-- Product image-->
    <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" alt="..." />
    <!-- Product details-->
    <div class="card-body p-4">
        <div class="text-center">
            <!-- Product name-->
            <h5 class="fw-bolder"><?php echo $model->title ?></h5>
            <p class="fw-bolder"><?php echo $model->getShortBody() ?></p>
            <!-- Product price-->
            <!-- <span class="text-muted text-decoration-line-through">$20.00</span> -->
            <?php echo Yii::$app->formatter->asCurrency($model->price) ?>$
        </div>

    </div>
    <!-- Product actions-->
    <div class="card-footer text-right">
        <a href="<?php echo Url::to(['/cart/add']) ?>" class="btn btn-primary btn-add-to-cart">
            Add To Cart
        </a>
    </div>
</div>