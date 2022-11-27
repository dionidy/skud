<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Move $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="move-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'in')->textInput() ?>

    <?= $form->field($model, 'out')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
