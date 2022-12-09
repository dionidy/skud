<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Move $model */
/** @var yii\widgets\ActiveForm $form */


$this->title = $model->isNewRecord ? 'Создать движение' : 'Изменить движение';
$this->params['breadcrumbs'][] = ['label' => 'Движения сотрудников', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="create-move">

    <h1><?= Html::encode($this->title) ?></h1>

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

</div>
