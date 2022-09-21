<?php

/** @var common\models\Product $model */

?>

    <div class="card h-100">
        <!-- Sale badge-->
        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo $model->category->title ?></div>
        <!-- Product image-->
        <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" alt="..." />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder"><?php echo $model->title ?></h5>
                <p class="fw-bolder"><?php echo $model->body ?></p>
                <!-- Product price-->
                <!-- <span class="text-muted text-decoration-line-through">$20.00</span> -->
                <?php echo $model->price ?>$
            </div>
            
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
        </div>
    </div>
