<?php
/** @var array $items */

use yii\helpers\Url;

?>


<div class="card">
    <div class="card-header">
        <h3>Your cart items</h3>
    </div>
    <div class="card-body p-0">

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <?php $product = $item->getProduct(); ?>
                <?php $totalCost = $item->getCost(); ?>


                <tr>
                    <td><?php echo $product->title ?></td>
                    <td>
                        <img src="<?php echo \common\models\Product::formatImageUrl($product->image) ?>"
                             style="width: 50px;"
                             alt="<?php echo $product->title ?>">
                    </td>
                    <td><?php echo $product->price ?></td>
                    <td><?php echo 1 ?>
                    <?php echo \yii\helpers\Html::a('+', Url::to(['/cart/addQuantity' , 'id' => $product->id]), [
                            'class' => 'btn btn-primary btn-sm',
                            // 'data-method' => 'post',
                    ]) ?></td>
                    <td><?php echo $totalCost ?></td>
                    <td>
                        <?php echo \yii\helpers\Html::a('Delete', ['/cart/delete', 'id' => $product->id], [
                            'class' => 'btn btn-outline-danger btn-sm',
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure you want to remove this product from cart?'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="card-body text-right">
            <a href="<?php echo \yii\helpers\Url::to(['/cart/checkout']) ?>" class="btn btn-primary">Checkout</a>
            <?php foreach ($items as $item): ?>
                <?php $product = $item->getProduct(); ?>
                <?php $total = 0; ?>
                <?php $total = $total + $product->price; ?> 
                
            
            <?php endforeach; ?>

        </div>
        <div class="card-body text-left">

        <span class="btn btn-primary">Total: <?php echo $total ?>$ </span>
        </div>
        

    </div>
</div>