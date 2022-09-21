<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]);?>

    <?=$form->field($model, 'category_id')->textInput()?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'body')->textarea(['rows' => 6])?>

    <?=$form->field($model, 'price')->textInput()?>

    <?=$form->field($model, 'imageFile', [
    'template' => '
                <div class="custom-file">
                    {input}
                    {label}
                    {error}
                </div>
            ',
    'labelOptions' => ['class' => 'custom-file-label'],
    'inputOptions' => ['class' => 'custom-file-input'],
])->textInput(['type' => 'file'])?>

<?=$form->field($model, 'created_at')->textInput()?>

<?=$form->field($model, 'updated_at')->textInput()?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
