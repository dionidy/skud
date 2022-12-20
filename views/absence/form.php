<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use yii\bootstrap5;


/** @var yii\web\View $this */
/** @var app\models\Absence $model */
/** @var yii\widgets\ActiveForm $form */
/** @var absenceTypes */
/** @var employeeFio */

$this->title = $model->isNewRecord ? 'Создать отсутствие пользователя' : 'Изменить отсутствие';
$this->params['breadcrumbs'][] = ['label' => 'Отсутствия пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="absence-modify">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="absence-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'employee_id')->dropDownList($employeeFio) ?>

        <?= $form->field($model, 'type_id')->dropDownList($absenceTypes) ?>

        <?= $form->field($model, 'date_start')->widget(DatePicker::class,[
            'value'     => date('d-M-Y'),
            'options'   => ['placeholder' => 'Выберите дату начала']
        ]) ?>

        <?= $form->field($model, 'date_end')->widget(DatePicker::class,[
            'value'     => date('d-M-Y'),
            'options'   => ['placeholder' => 'Выберите дату окончания']
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>