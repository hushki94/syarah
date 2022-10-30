<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yii\data\ActiveDataProvider $dataProvider */


$this->title = 'My Yii Application';
?>
<header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Your Best Choices For Cars</p>
                </div>
            </div>
        </header>
        <!-- Section Category-->
        <section class="page-section py-5" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Categories</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row text-center">
                    <?php foreach($categories as $category): ?>
                    <div class="col-md-4 border">
                    <?= Html::a('products' , Url::to(['/site/product-by-category' , 'id' => $category->id] , ['options' =>['class' =>'btn btn-outline-dark mt-auto']]))?>
                        <span class="fa-stack fa-4x">
                            <img src="https://as2.ftcdn.net/v2/jpg/01/71/86/53/1000_F_171865305_SN6KBMjHdhoI7ep7dH464TrIKmlzZF8r.jpg" class="w-50 m-4 rounded-circle" alt="">
                        </span>
                        <h4 class="my-3"><?php echo $category->title ?></h4>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- End Section Category-->

        <!-- Section Product-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="col-md-12">
                <?php echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => '{summary} <div class="row">{items}</div> {pager}',
                        'itemView' => '_product_item',
                        'itemOptions' => [
                            'class' => 'col mb-5 product-item'
                        ],
                        'pager' => [
                            'class' => \yii\bootstrap5\LinkPager::class
                        ]
                    ]) ?>
                    
                    
                </div>
            </div>
        </section>
        <!-- End Section Product-->

