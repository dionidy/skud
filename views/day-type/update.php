<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DayType $model */

$this->title = 'Update Day Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Day Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="day-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
