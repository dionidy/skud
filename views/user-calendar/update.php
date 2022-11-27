<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserCalendar $model */

$this->title = 'Update User Calendar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Calendars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-calendar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
