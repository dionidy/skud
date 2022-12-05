<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Calendar $model */

$this->title = 'Добавить не рабочий день';
$this->params['breadcrumbs'][] = ['label' => 'Calendars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dayTypes'=> $dayTypes,
    ]) ?>

</div>
