<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Calendar $model */
/** @var yii\widgets\ActiveForm $form */

/** @var array $dayTypes */

$this->title = $model->isNewRecord ? 'Создать день' : 'Изменить день';
$this->params['breadcrumbs'][] = ['label' => 'Календарь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="calendar-modify">

    <h1> <?= Html::encode($this->title) ?> </h1>

    <div class="calendar-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'date')->textInput() ?>

        <?= $form->field($model, 'type_id')->dropDownList($dayTypes) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>