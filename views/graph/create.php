<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Graph $model */

$this->title = 'Create Graph';
$this->params['breadcrumbs'][] = ['label' => 'Graphs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="graph-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
