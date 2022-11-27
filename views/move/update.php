<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Move $model */

$this->title = 'Update Move: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Moves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="move-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
