<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dep $model */

$this->title = 'Create Dep';
$this->params['breadcrumbs'][] = ['label' => 'Deps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
