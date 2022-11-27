<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserCalendar $model */

$this->title = 'Create User Calendar';
$this->params['breadcrumbs'][] = ['label' => 'User Calendars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-calendar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
