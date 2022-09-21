<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card h-100">
        <!-- Sale badge-->
        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo $product->category->title ?></div>
        <!-- Product image-->
        <img class="card-img-top" src="<?php echo $product->getImageUrl() ?>" alt="..." />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?php echo $product->title ?></h5>
                <p class="fw-bolder"><?php echo $product->body ?></p>
                <!-- Product price-->
                <!-- <span class="text-muted text-decoration-line-through">$20.00</span> -->
                <?php echo $product->price ?>$
                <p class="fw-bolder">Category: <?php echo $product->category->title ?></p>


            </div>
            
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><?= Html::a('addToCart' , Url::to(['/cart/add' , 'id' => $product->id] , ['class' =>'btn btn-outline-dark mt-auto']))?></div>
        </div>
    </div>