<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yii\data\ActiveDataProvider $dataProvider */


$this->title = 'My Yii Application';
?>


<div class="container px-4 px-lg-5 mt-5">
                <div class="col-md-12">
                <?php echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => '{summary} <div class="row">{items}</div> {pager}',
                        'itemView' => '_product_item',
                        'itemOptions' => [
                            'class' => 'col mb-5'
                        ],
                        'pager' => [
                            'class' => \yii\bootstrap5\LinkPager::class
                        ]
                    ]) ?>
                    
                    
                </div>
            </div>