<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */

/** @var array dep_list */
/** @var array graph_list */


$this->title = $model->isNewRecord ? 'Создать сотрудника' : 'Изменить сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="employee-modify">

    <div class="employee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'num')->textInput() ?>

        <?= $form->field($model, 'dep_id')->dropDownList($dep_list) ?>

        <?= $form->field($model, 'graph_id')->dropDownList($graph_list) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>



        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>