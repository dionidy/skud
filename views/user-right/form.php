<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserRight $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = $model->isNewRecord ? 'Создать доступ' : 'Изменить доступ';
$this->params['breadcrumbs'][] = ['label' => 'Доступ пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-right-modify">
    
    <h1><?= Html::encode($this->title) ?></h1>
   
    <div class="user-right-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'type')->textInput() ?>

        <?= $form->field($model, 'dep_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>