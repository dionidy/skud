<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DayType $model */

$this->title = 'Create Day Type';
$this->params['breadcrumbs'][] = ['label' => 'Day Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
